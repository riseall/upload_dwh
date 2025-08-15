<?php

namespace App\Http\Controllers;

use App\Models\SellOutAME;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SellOutAMEController extends Controller
{
    public function index()
    {
        return view('sell_out_ame.index');
    }

    public function getData(Request $request)
    {
        $data = SellOutAme::select([
            'distributor',
            'nacabdist',
            'segment_mi',
            'segment',
            'cust_id',
            'pnamlang',
            'alamat',
            'kota',
            'faktur',
            'nabarmi',
            'sled',
            'sub_sektor',
            'satuan',
            'supplier_batch',
            'unit',
            'bruto',
            'netto_peha',
            'hpc',
            'bulan',
            'pilar',
            'kodbarpab',
            'tanggal',
            'minggu',
            'cabang',
            'segmen_baru',
            'divisi',
            'pilar_baru',
            'regional',
            'nama_pm',
            'segment_khusus',
            'nama_mr_sr',
            'id_ter',
            'nip_mr_sr',
            'nama_am',
            'nama_sam',
            'wilayah',
            'disc',
            'kelompok_disc',
            'batch'
        ]);

        // Proses data menggunakan Yajra DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('unit', function ($row) {
                // Format kolom 'unit' dengan pemisah ribuan
                return (float) $row->unit;
            })
            ->editColumn('bruto', function ($row) {
                // Format kolom 'bruto' dengan pemisah ribuan
                return number_format((float) $row->bruto, 2, '.', ',');
            })
            ->editColumn('netto_peha', function ($row) {
                // Format kolom 'netto_peha' dengan pemisah ribuan
                return number_format((float) $row->netto_peha, 2, '.', ',');
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
            SellOutAME::whereDate('created_at', $today)->delete();

            // Baca header terlebih dahulu dan buat pemetaan field
            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                "distributor" => "distributor",
                "nacabdist" => "nacabdist",
                "segment_mi" => "segment_mi",
                "segment" => "segment",
                "cust_id" => "cust_id",
                "pnamlang" => "pnamlang",
                "alamat" => "alamat",
                "kota" => "kota",
                "faktur" => "faktur",
                "nabarmi" => "nabarmi",
                "sled" => "sled",
                "sub_sektor" => "sub_sektor",
                "satuan" => "satuan",
                "supplier_batch" => "supplier_batch",
                "unit" => "unit",
                "bruto" => "bruto",
                "netto_peha" => "netto_peha",
                "hpc" => "hpc",
                "bulan" => "bulan",
                "pilar" => "pilar",
                "kodbarpab" => "kodbarpab",
                "tanggal" => "tanggal",
                "minggu" => "minggu",
                "cabang" => "cabang",
                "segmen_baru" => "segmen_baru",
                "divisi" => "divisi",
                "pilar_baru" => "pilar_baru",
                "regional" => "regional",
                "nama_pm" => "nama_pm",
                "segment_khusus" => "segment_khusus",
                "nama_mr_sr" => "nama_mr_sr",
                "id_ter" => "id_ter",
                "nip_mr_sr" => "nip_mr_sr",
                "nama_am" => "nama_am",
                "nama_sam" => "nama_sam",
                "wilayah" => "wilayah",
                "disc" => "disc",
                "kelompok_disc" => "kelompok_disc",
                "batch" => "batch"
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
                    SellOutAME::create([
                        "distributor" => $mappedRow["distributor"],
                        "nacabdist" => $mappedRow["nacabdist"],
                        "segment_mi" => $mappedRow["segment_mi"],
                        "segment" => $mappedRow["segment"],
                        "cust_id" => $mappedRow["cust_id"],
                        "pnamlang" => $mappedRow["pnamlang"],
                        "alamat" => $mappedRow["alamat"],
                        "kota" => $mappedRow["kota"],
                        "faktur" => $mappedRow["faktur"],
                        "nabarmi" => $mappedRow["nabarmi"],
                        "sled" => $mappedRow["sled"],
                        "sub_sektor" => $mappedRow["sub_sektor"],
                        "satuan" => $mappedRow["satuan"],
                        "supplier_batch" => $mappedRow["supplier_batch"],
                        "unit" => $mappedRow["unit"],
                        "bruto" => $mappedRow["bruto"],
                        "netto_peha" => $mappedRow["netto_peha"],
                        "hpc" => $mappedRow["hpc"],
                        "bulan" => $mappedRow["bulan"],
                        "pilar" => $mappedRow["pilar"],
                        "kodbarpab" => $mappedRow["kodbarpab"],
                        "tanggal" => $mappedRow["tanggal"],
                        "minggu" => $mappedRow["minggu"],
                        "cabang" => $mappedRow["cabang"],
                        "segmen_baru" => $mappedRow["segmen_baru"],
                        "divisi" => $mappedRow["divisi"],
                        "pilar_baru" => $mappedRow["pilar_baru"],
                        "regional" => $mappedRow["regional"],
                        "nama_pm" => $mappedRow["nama_pm"],
                        "segment_khusus" => $mappedRow["segment_khusus"],
                        "nama_mr_sr" => $mappedRow["nama_mr_sr"],
                        "id_ter" => $mappedRow["id_ter"],
                        "nip_mr_sr" => $mappedRow["nip_mr_sr"],
                        "nama_am" => $mappedRow["nama_am"],
                        "nama_sam" => $mappedRow["nama_sam"],
                        "wilayah" => $mappedRow["wilayah"],
                        "disc" => $mappedRow["disc"],
                        "kelompok_disc" => $mappedRow["kelompok_disc"],
                        "batch" => $mappedRow["batch"]
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('sell_out_ame.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sell_out_ame.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
