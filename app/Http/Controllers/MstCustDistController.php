<?php

namespace App\Http\Controllers;

use App\Models\MstCustDist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Yajra\DataTables\Facades\DataTables;

class MstCustDistController extends Controller
{
    public function index()
    {
        return view('mst_cust_dist.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = MstCustDist::query();
            return DataTables::of($query)->addIndexColumn()
                ->make(true);
        }
    }

    public function create()
    {
        return view('mst_cust_dist.create');
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
            MstCustDist::whereDate('created_at', $today)->delete();

            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                'id_outlet' => 'id_outlet',
                'id_cbg_dist' => 'id_cbg_dist',
                'id_outlet_cbg' => 'id_outlet_cbg',
                'nama_outlet' => 'nama_outlet',
                'alamat_1' => 'alamat_1',
                'alamat_2' => 'alamat_2',
                'alamat_' => 'alamat_',
                'no_telp' => 'no_telp',
                'segment' => 'segment',
                'pasar' => 'pasar',
                'dist' => 'dist',
            ];


            // Validasi header
            $header = array_map('trim', $header); // Bersihkan spasi dari header
            foreach (array_keys($csvToDbMapping) as $key) {
                if (!in_array($key, $header)) {
                    throw new \Exception("Header CSV tidak valid. Field {$key} tidak ditemukan.");
                }
            }

            $lineNumber = 1;
            $validPasarValues = ['REGULER', 'NON-REGULER'];

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
                $pasarValue = $mappedRow['pasar'];
                if (!in_array($pasarValue, $validPasarValues)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Nilai field pasar tidak valid. Nilai yang diizinkan adalah REGULER atau NON-REGULER.");
                }

                try {
                    MstCustDist::create([
                        'id_outlet' => $mappedRow['id_outlet'],
                        'id_cbg_dist' => $mappedRow['id_cbg_dist'],
                        'id_outlet_cbg' => $mappedRow['id_outlet_cbg'],
                        'nama_outlet' => $mappedRow['nama_outlet'],
                        'alamat_1' => $mappedRow['alamat_1'],
                        'alamat_2' => $mappedRow['alamat_2'],
                        'alamat_' => $mappedRow['alamat_'],
                        'no_telp' => $mappedRow['no_telp'],
                        'segment' => $mappedRow['segment'],
                        'pasar' => $pasarValue,
                        'dist' => $mappedRow['dist'],
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('mst_cust_dist.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('mst_cust_dist.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
