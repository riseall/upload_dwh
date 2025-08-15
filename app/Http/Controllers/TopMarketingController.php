<?php

namespace App\Http\Controllers;

use App\Models\TopMarketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TopMarketingController extends Controller
{
    public function index()
    {
        return view('top_marketing.index');
    }

    public function getData(Request $request)
    {
        $data = TopMarketing::select([
            'tahun',
            'bulan',
            'divisi',
            'region',
            'pm',
            'pilar',
            'kode_ph',
            'nama_prod',
            'satuan',
            'netto',
            'cbg',
            'cbg_new',
            'dist',
            'unit',
            'val_nett'
        ]);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('netto', function ($row) {
                // Konversi ke float, lalu format dengan pemisah ribuan (,)
                return number_format((float) $row->netto, 2, '.', ',');
            })
            ->editColumn('unit', function ($row) {
                // Konversi ke float
                return (float) $row->unit;
            })
            ->editColumn('val_nett', function ($row) {
                // Konversi ke float, lalu format dengan pemisah ribuan (,)
                return number_format((float) $row->val_nett, 2, '.', ',');
            })
            ->make(true);
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
            TopMarketing::whereDate('created_at', $today)->delete();

            // Baca header terlebih dahulu dan buat pemetaan field
            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                'tahun' => 'tahun',
                'bulan' => 'bulan',
                'divisi' => 'divisi',
                'region' => 'region',
                'pm' => 'pm',
                'pilar' => 'pilar',
                'kode_ph' => 'kode_ph',
                'nama_prod' => 'nama_prod',
                'satuan' => 'satuan',
                'netto' => 'netto',
                'cbg' => 'cbg',
                'cbg_new' => 'cbg_new',
                'dist' => 'dist',
                'unit' => 'unit',
                'val_nett' => 'val_nett',
            ];

            // Validasi header
            $header = array_map('trim', $header); // Bersihkan spasi dari header
            foreach (array_keys($csvToDbMapping) as $key) {
                if (!in_array($key, $header)) {
                    throw new \Exception("Header CSV tidak valid. Field {$key} tidak ditemukan.");
                }
            }

            $lineNumber = 1;

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

                try {
                    TopMarketing::create([
                        'tahun' => $mappedRow['tahun'],
                        'bulan' => $mappedRow['bulan'],
                        'divisi' => $mappedRow['divisi'],
                        'region' => $mappedRow['region'],
                        'pm' => $mappedRow['pm'],
                        'pilar' => $mappedRow['pilar'],
                        'kode_ph' => $mappedRow['kode_ph'],
                        'nama_prod' => $mappedRow['nama_prod'],
                        'satuan' => $mappedRow['satuan'],
                        'netto' => $mappedRow['netto'],
                        'cbg' => $mappedRow['cbg'],
                        'cbg_new' => $mappedRow['cbg_new'],
                        'dist' => $mappedRow['dist'],
                        'unit' => $mappedRow['unit'],
                        'val_nett' => $mappedRow['val_nett'],
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('top_marketing.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('top_marketing.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
