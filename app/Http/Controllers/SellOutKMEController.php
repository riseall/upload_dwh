<?php

namespace App\Http\Controllers;

use App\Models\SellOutKME;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SellOutKMEController extends Controller
{
    public function index()
    {
        return view('sell_out_kme.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = SellOutKME::query();
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
            SellOutKME::whereDate('created_at', $today)->delete();

            // Baca header terlebih dahulu dan buat pemetaan field
            $header = fgetcsv($file, 0, ';', '"');

            // Pemetaan dari nama field di CSV ke nama field di database
            $csvToDbMapping = [
                'sales_office' => 'sales_office',
                'desc_s_office' => 'desc_s_office',
                'so_type' => 'so_type',
                'desc_sales_order' => 'desc_sales_order',
                'billing_type' => 'billing_type',
                'posting_date' => 'posting_date',
                'posting_date_temp' => 'posting_date_temp',
                'billing_no' => 'billing_no',
                'posting_status' => 'posting_status',
                'bill_cancel' => 'bill_cancel',
                'bill_to_party' => 'bill_to_party',
                'sold_to_party' => 'sold_to_party',
                'name_bill_to' => 'name_bill_to',
                'address' => 'address',
                'city' => 'city',
                'region' => 'region',
                'postal_code' => 'postal_code',
                'ship_to_party' => 'ship_to_party',
                'name_ship_to' => 'name_ship_to',
                'address_ship_to' => 'address_ship_to',
                'city_ship_to' => 'city_ship_to',
                'postal_code_ship_to' => 'postal_code_ship_to',
                'material' => 'material',
                'text_material' => 'text_material',
                'sales_unit' => 'sales_unit',
                'bill_qty_in_sku' => 'bill_qty_in_sku',
                'uom_sku' => 'uom_sku',
                'quantity' => 'quantity',
                'unit_price_penjualan' => 'unit_price_penjualan',
                'dis_zd01_percent' => 'dis_zd01_percent',
                'dis_zd01_amount' => 'dis_zd01_amount',
                'dis_zd02_percent' => 'dis_zd02_percent',
                'dis_zd02_amount' => 'dis_zd02_amount',
                'dis_zd03_percent' => 'dis_zd03_percent',
                'dis_zd03_amount' => 'dis_zd03_amount',
                'dis_zd04_percent' => 'dis_zd04_percent',
                'dis_zd04_amount' => 'dis_zd04_amount',
                'dis_zd05_percent' => 'dis_zd05_percent',
                'dis_zd05_amount' => 'dis_zd05_amount',
                'dis_zd06_percent' => 'dis_zd06_percent',
                'dis_zd06_amount' => 'dis_zd06_amount',
                'total_discount' => 'total_discount',
                'surcharge' => 'surcharge',
                'total_penjualan' => 'total_penjualan',
                'total_cogs' => 'total_cogs',
                'persentase' => 'persentase',
                'curr' => 'curr',
                'code_pelayanan' => 'code_pelayanan',
                'dec_pelayanan' => 'dec_pelayanan',
                'prodh_material' => 'prodh_material',
                'prod_hierarchy1' => 'prod_hierarchy1',
                'prod_hierarchy2' => 'prod_hierarchy2',
                'prod_hierarchy3' => 'prod_hierarchy3',
                'prod_hierarchy4' => 'prod_hierarchy4',
                'manufactur' => 'manufactur',
                'name_manufactur' => 'name_manufactur',
                'principle' => 'principle',
                'name_principle' => 'name_principle',
                'cust_grp1' => 'cust_grp1',
                'desc_cust_grp1' => 'desc_cust_grp1',
                'cust_grp2' => 'cust_grp2',
                'desc_cust_grp2' => 'desc_cust_grp2',
                'cust_grp3' => 'cust_grp3',
                'desc_cust_grp3' => 'desc_cust_grp3',
                'cust_grp4' => 'cust_grp4',
                'desc_cust_grp4' => 'desc_cust_grp4',
                'salesman' => 'salesman',
                'name_salesman' => 'name_salesman',
                'order_reason' => 'order_reason',
                'order_note' => 'order_note',
                'cancelled_bill_doc' => 'cancelled_bill_doc',
                'c_bill_doc_creation_date' => 'c_bill_doc_creation_date',
                'so_number' => 'so_number',
                'cust_po_no' => 'cust_po_no',
                'do_number' => 'do_number',
                'po_number' => 'po_number',
                'tanggal_po' => 'tanggal_po',
                'batch' => 'batch',
                'supplier_batch' => 'supplier_batch',
                'sled' => 'sled',
                'remark_ptd2' => 'remark_ptd2',
                'remark_ptd3' => 'remark_ptd3',
                'remark_ptd4' => 'remark_ptd4',
                'nilai_netto' => 'nilai_netto',
                'nilai_bruto' => 'nilai_bruto',
                'diskon_phapros' => 'diskon_phapros',
                'ppn' => 'ppn',
                'page' => 'page',
                'dist' => 'dist',
                'total_bayar' => 'total_bayar',
                'uuid' => 'uuid',
                'upload_date' => 'upload_date',
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
                    SellOutKME::create([
                        'sales_office' => $mappedRow['sales_office'],
                        'desc_s_office' => $mappedRow['desc_s_office'],
                        'so_type' => $mappedRow['so_type'],
                        'desc_sales_order' => $mappedRow['desc_sales_order'],
                        'billing_type' => $mappedRow['billing_type'],
                        'posting_date' => $mappedRow['posting_date'],
                        'posting_date_temp' => $mappedRow['posting_date_temp'],
                        'billing_no' => $mappedRow['billing_no'],
                        'posting_status' => $mappedRow['posting_status'],
                        'bill_cancel' => $mappedRow['bill_cancel'],
                        'bill_to_party' => $mappedRow['bill_to_party'],
                        'sold_to_party' => $mappedRow['sold_to_party'],
                        'name_bill_to' => $mappedRow['name_bill_to'],
                        'address' => $mappedRow['address'],
                        'city' => $mappedRow['city'],
                        'region' => $mappedRow['region'],
                        'postal_code' => $mappedRow['postal_code'],
                        'ship_to_party' => $mappedRow['ship_to_party'],
                        'name_ship_to' => $mappedRow['name_ship_to'],
                        'address_ship_to' => $mappedRow['address_ship_to'],
                        'city_ship_to' => $mappedRow['city_ship_to'],
                        'postal_code_ship_to' => $mappedRow['postal_code_ship_to'],
                        'material' => $mappedRow['material'],
                        'text_material' => $mappedRow['text_material'],
                        'sales_unit' => $mappedRow['sales_unit'],
                        'bill_qty_in_sku' => $mappedRow['bill_qty_in_sku'],
                        'uom_sku' => $mappedRow['uom_sku'],
                        'quantity' => $mappedRow['quantity'],
                        'unit_price_penjualan' => $mappedRow['unit_price_penjualan'],
                        'dis_zd01_percent' => $mappedRow['dis_zd01_percent'],
                        'dis_zd01_amount' => $mappedRow['dis_zd01_amount'],
                        'dis_zd02_percent' => $mappedRow['dis_zd02_percent'],
                        'dis_zd02_amount' => $mappedRow['dis_zd02_amount'],
                        'dis_zd03_percent' => $mappedRow['dis_zd03_percent'],
                        'dis_zd03_amount' => $mappedRow['dis_zd03_amount'],
                        'dis_zd04_percent' => $mappedRow['dis_zd04_percent'],
                        'dis_zd04_amount' => $mappedRow['dis_zd04_amount'],
                        'dis_zd05_percent' => $mappedRow['dis_zd05_percent'],
                        'dis_zd05_amount' => $mappedRow['dis_zd05_amount'],
                        'dis_zd06_percent' => $mappedRow['dis_zd06_percent'],
                        'dis_zd06_amount' => $mappedRow['dis_zd06_amount'],
                        'total_discount' => $mappedRow['total_discount'],
                        'surcharge' => $mappedRow['surcharge'],
                        'total_penjualan' => $mappedRow['total_penjualan'],
                        'total_cogs' => $mappedRow['total_cogs'],
                        'persentase' => $mappedRow['persentase'],
                        'curr' => $mappedRow['curr'],
                        'code_pelayanan' => $mappedRow['code_pelayanan'],
                        'dec_pelayanan' => $mappedRow['dec_pelayanan'],
                        'prodh_material' => $mappedRow['prodh_material'],
                        'prod_hierarchy1' => $mappedRow['prod_hierarchy1'],
                        'prod_hierarchy2' => $mappedRow['prod_hierarchy2'],
                        'prod_hierarchy3' => $mappedRow['prod_hierarchy3'],
                        'prod_hierarchy4' => $mappedRow['prod_hierarchy4'],
                        'manufactur' => $mappedRow['manufactur'],
                        'name_manufactur' => $mappedRow['name_manufactur'],
                        'principle' => $mappedRow['principle'],
                        'name_principle' => $mappedRow['name_principle'],
                        'cust_grp1' => $mappedRow['cust_grp1'],
                        'desc_cust_grp1' => $mappedRow['desc_cust_grp1'],
                        'cust_grp2' => $mappedRow['cust_grp2'],
                        'desc_cust_grp2' => $mappedRow['desc_cust_grp2'],
                        'cust_grp3' => $mappedRow['cust_grp3'],
                        'desc_cust_grp3' => $mappedRow['desc_cust_grp3'],
                        'cust_grp4' => $mappedRow['cust_grp4'],
                        'desc_cust_grp4' => $mappedRow['desc_cust_grp4'],
                        'salesman' => $mappedRow['salesman'],
                        'name_salesman' => $mappedRow['name_salesman'],
                        'order_reason' => $mappedRow['order_reason'],
                        'order_note' => $mappedRow['order_note'],
                        'cancelled_bill_doc' => $mappedRow['cancelled_bill_doc'],
                        'c_bill_doc_creation_date' => $mappedRow['c_bill_doc_creation_date'],
                        'so_number' => $mappedRow['so_number'],
                        'cust_po_no' => $mappedRow['cust_po_no'],
                        'do_number' => $mappedRow['do_number'],
                        'po_number' => $mappedRow['po_number'],
                        'tanggal_po' => $mappedRow['tanggal_po'],
                        'batch' => $mappedRow['batch'],
                        'supplier_batch' => $mappedRow['supplier_batch'],
                        'sled' => $mappedRow['sled'],
                        'remark_ptd2' => $mappedRow['remark_ptd2'],
                        'remark_ptd3' => $mappedRow['remark_ptd3'],
                        'remark_ptd4' => $mappedRow['remark_ptd4'],
                        'nilai_netto' => $mappedRow['nilai_netto'],
                        'nilai_bruto' => $mappedRow['nilai_bruto'],
                        'diskon_phapros' => $mappedRow['diskon_phapros'],
                        'ppn' => $mappedRow['ppn'],
                        'page' => $mappedRow['page'],
                        'dist' => $mappedRow['dist'],
                        'total_bayar' => $mappedRow['total_bayar'],
                        'uuid' => $mappedRow['uuid'],
                        'upload_date' => $mappedRow['upload_date'],
                    ]);
                } catch (\Exception $e) {
                    throw new \Exception("Kesalahan pada baris {$lineNumber}: " . $e->getMessage());
                }
            }

            fclose($file);
            DB::commit();

            return redirect()->route('sell_out_kme.index')->with('success', 'Data CSV berhasil diupload dan disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sell_out_kme.index')->with('error', 'Terjadi kesalahan saat memproses file: ' . $e->getMessage());
        }
    }
}
