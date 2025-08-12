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
            $headerColumnCount = count($header);
            $lineNumber = 1;

            $validPasarValues = ['REGULER', 'NON-REGULER'];

            DB::beginTransaction();
            while (($row = fgetcsv($file, 0, ';', '"')) !== false) {
                $lineNumber++;

                // Lewati baris yang kosong
                if (empty(array_filter($row, fn($value) => $value !== null && $value !== ''))) {
                    continue;
                }

                if (count($row) !== $headerColumnCount) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Jumlah kolom tidak sesuai dengan header. Mohon periksa file csv anda.");
                }

                $pasarValue = trim($row[9]);
                $telpValue = trim($row[7]);

                if (!in_array($pasarValue, $validPasarValues)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Nilai kolom pasar tidak valid. Nilai yang diizinkan adalah REGULER atau NON-REGULER.");
                }

                if (!is_numeric($telpValue)) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: Nilai kolom 'no_telp' harus berupa angka.");
                }

                try {
                    MstCustDist::create([
                        'id_outlet'     => trim($row[0]),
                        'id_cbg_dist'   => trim($row[1]),
                        'id_outlet_cbg' => trim($row[2]),
                        'nama_outlet'   => trim($row[3]),
                        'alamat_1'      => trim($row[4]),
                        'alamat_2'      => trim($row[5]),
                        'alamat_3'      => trim($row[6]),
                        'no_telp'       => $telpValue,
                        'segment'       => trim($row[8]),
                        'pasar'         => $pasarValue,
                        'dist'          => trim($row[10]),
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
