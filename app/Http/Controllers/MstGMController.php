<?php

namespace App\Http\Controllers;

use App\Models\MstGM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MstGMController extends Controller
{
    public function index()
    {
        return view('mst_gm.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = MstGM::query();
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
            MstGM::whereDate('created_at', $today)->delete();

            // Baca header terlebih dahulu dan buat pemetaan field
            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                'nik_gm' => 'nik_gm',
                'nama_gm' => 'nama_gm',
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
                    MstGM::create([
                        'nik_gm' => $mappedRow['nik_gm'],
                        'nama_gm' => $mappedRow['nama_gm'],
                        'subdiv' => $subdivValue
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('mst_gm.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('mst_gm.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
