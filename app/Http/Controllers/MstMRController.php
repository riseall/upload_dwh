<?php

namespace App\Http\Controllers;

use App\Models\MstMR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MstMRController extends Controller
{
    public function index()
    {
        return view('mst_mr.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = MstMR::query();
            return DataTables::of($query)->addIndexColumn()
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            $path = $request->file('file')->getRealPath();
            $file = fopen($path, 'r');

            $today = now()->toDateString();
            MstMR::whereDate('created_at', $today)->delete();

            // Baca header terlebih dahulu dan buat pemetaan field
            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                'nik_mr' => 'mr_nik',
                'nik_am' => 'am_nik',
                'nama_mr' => 'nama_mr',
                'pilar' => 'pilar',
                'id_cbg' => 'id_cbg',
                'subdiv' => 'subdiv',
            ];

            // Validasi header
            $header = array_map('trim', $header); // Bersihkan spasi dari header
            foreach (array_keys($csvToDbMapping) as $key) {
                if (!in_array($key, $header)) {
                    throw new \Exception("Header CSV tidak valid. Field {$key} tidak ditemukan.");
                }
            }

            $lineNumber = 1;
            $validSubdivValues = ['REGULER', 'NON-REGULER'];

            DB::beginTransaction();
            while (($row = fgetcsv($file, 0, ';', '"')) !== false) {
                $lineNumber++;

                // Lewati baris yang kosong
                if (empty(array_filter($row, fn($value) => $value !== null && $value !== ''))) {
                    continue;
                }

                // Cek jumlah field
                if (count($row) !== count($header)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Jumlah field tidak sesuai dengan header. Mohon periksa file csv anda.");
                }

                $mappedRow = array_combine($header, array_map('trim', $row));

                // Validasi field 'subdiv'
                $subdivValue = $mappedRow['subdiv'];
                if (!in_array($subdivValue, $validSubdivValues)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Nilai field subdiv tidak valid. Nilai yang diizinkan adalah REGULER atau NON-REGULER.");
                }

                try {
                    MstMR::create([
                        'mr_nik' => $mappedRow['nik_mr'],
                        'am_nik' => $mappedRow['nik_am'],
                        'nama_mr' => $mappedRow['nama_mr'],
                        'pilar' => $mappedRow['pilar'],
                        'id_cbg' => $mappedRow['id_cbg'],
                        'subdiv' => $subdivValue
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('mst_mr.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('mst_mr.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
