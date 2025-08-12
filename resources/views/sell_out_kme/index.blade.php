@extends('layouts.app', ['title' => 'Selling Out KME'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Selling Out',
        'subtitle' => 'Koperasi Menjangan Enam (KME)',
        'columns' => [
            'sales office',
            'desc office',
            'so type',
            'desc sales order',
            'billing type',
            'posting date',
            'posting date temp',
            'billing no',
            'posting status',
            'bill cancel',
            'bill to party',
            'sold to party',
            'name bill to',
            'address',
            'city',
            'region',
            'postal code',
            'ship to party',
            'name ship to',
            'address ship to',
            'city ship to',
            'postal code ship to',
            'material',
            'text material',
            'sales unit',
            'bill qty in sku',
            'uom sku',
            'quantity',
            'unit price penjualan',
            'dis zd01 percent',
            'dis zd01 amount',
            'dis zd02 percent',
            'dis zd02 amount',
            'dis zd03 percent',
            'dis zd03 amount',
            'dis zd04 percent',
            'dis zd04 amount',
            'dis zd05 percent',
            'dis zd05 amount',
            'dis zd06 percent',
            'dis zd06 amount',
            'total discount',
            'surcharge',
            'total penjualan',
            'total cogs',
            'persentase',
            'curr',
            'code pelayanan',
            'dec pelayanan',
            'prodh material',
            'prod hierarchy1',
            'prod hierarchy2',
            'prod hierarchy3',
            'prod hierarchy4',
            'manufactur',
            'name manufactur',
            'principle',
            'name principle',
            'cust grp1',
            'desc cust grp1',
            'cust grp2',
            'desc cust grp2',
            'cust grp3',
            'desc cust grp3',
            'cust grp4',
            'desc cust grp4',
            'salesman',
            'name salesman',
            'order reason',
            'order note',
            'cancelled bill doc',
            'c bill doc creation date',
            'so number',
            'cust po no',
            'do number',
            'po number',
            'tanggal po',
            'batch',
            'supplier batch',
            'sled',
            'remark ptd2',
            'remark ptd3',
            'remark ptd4',
            'nilai netto',
            'nilai bruto',
            'diskon phapros',
            'ppn',
            'page',
            'dist',
            'total bayar',
            'uuid',
            'upload date',
        ],
        'upload' => route('sell_out_kme.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sell_out_kme.data') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'sales_office',
                        name: 'sales_office'
                    },
                    {
                        data: 'desc_s_office',
                        name: 'desc_s_office'
                    },
                    {
                        data: 'so_type',
                        name: 'so_type'
                    },
                    {
                        data: 'desc_sales_order',
                        name: 'desc_sales_order'
                    },
                    {
                        data: 'billing_type',
                        name: 'billing_type'
                    },
                    {
                        data: 'posting_date',
                        name: 'posting_date'
                    },
                    {
                        data: 'posting_date_temp',
                        name: 'posting_date_temp'
                    },
                    {
                        data: 'billing_no',
                        name: 'billing_no'
                    },
                    {
                        data: 'posting_status',
                        name: 'posting_status'
                    },
                    {
                        data: 'bill_cancel',
                        name: 'bill_cancel'
                    },
                    {
                        data: 'bill_to_party',
                        name: 'bill_to_party'
                    },
                    {
                        data: 'sold_to_party',
                        name: 'sold_to_party'
                    },
                    {
                        data: 'name_bill_to',
                        name: 'name_bill_to'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'region',
                        name: 'region'
                    },
                    {
                        data: 'postal_code',
                        name: 'postal_code'
                    },
                    {
                        data: 'ship_to_party',
                        name: 'ship_to_party'
                    },
                    {
                        data: 'name_ship_to',
                        name: 'name_ship_to'
                    },
                    {
                        data: 'address_ship_to',
                        name: 'address_ship_to'
                    },
                    {
                        data: 'city_ship_to',
                        name: 'city_ship_to'
                    },
                    {
                        data: 'postal_code_ship_to',
                        name: 'postal_code_ship_to'
                    },
                    {
                        data: 'material',
                        name: 'material'
                    },
                    {
                        data: 'text_material',
                        name: 'text_material'
                    },
                    {
                        data: 'sales_unit',
                        name: 'sales_unit'
                    },
                    {
                        data: 'bill_qty_in_sku',
                        name: 'bill_qty_in_sku'
                    },
                    {
                        data: 'uom_sku',
                        name: 'uom_sku'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'unit_price_penjualan',
                        name: 'unit_price_penjualan'
                    },
                    {
                        data: 'dis_zd01_percent',
                        name: 'dis_zd01_percent'
                    },
                    {
                        data: 'dis_zd01_amount',
                        name: 'dis_zd01_amount'
                    },
                    {
                        data: 'dis_zd02_percent',
                        name: 'dis_zd02_percent'
                    },
                    {
                        data: 'dis_zd02_amount',
                        name: 'dis_zd02_amount'
                    },
                    {
                        data: 'dis_zd03_percent',
                        name: 'dis_zd03_percent'
                    },
                    {
                        data: 'dis_zd03_amount',
                        name: 'dis_zd03_amount'
                    },
                    {
                        data: 'dis_zd04_percent',
                        name: 'dis_zd04_percent'
                    },
                    {
                        data: 'dis_zd04_amount',
                        name: 'dis_zd04_amount'
                    },
                    {
                        data: 'dis_zd05_percent',
                        name: 'dis_zd05_percent'
                    },
                    {
                        data: 'dis_zd05_amount',
                        name: 'dis_zd05_amount'
                    },
                    {
                        data: 'dis_zd06_percent',
                        name: 'dis_zd06_percent'
                    },
                    {
                        data: 'dis_zd06_amount',
                        name: 'dis_zd06_amount'
                    },
                    {
                        data: 'total_discount',
                        name: 'total_discount'
                    },
                    {
                        data: 'surcharge',
                        name: 'surcharge'
                    },
                    {
                        data: 'total_penjualan',
                        name: 'total_penjualan'
                    },
                    {
                        data: 'total_cogs',
                        name: 'total_cogs'
                    },
                    {
                        data: 'persentase',
                        name: 'persentase'
                    },
                    {
                        data: 'curr',
                        name: 'curr'
                    },
                    {
                        data: 'code_pelayanan',
                        name: 'code_pelayanan'
                    },
                    {
                        data: 'dec_pelayanan',
                        name: 'dec_pelayanan'
                    },
                    {
                        data: 'prodh_material',
                        name: 'prodh_material'
                    },
                    {
                        data: 'prod_hierarchy1',
                        name: 'prod_hierarchy1'
                    },
                    {
                        data: 'prod_hierarchy2',
                        name: 'prod_hierarchy2'
                    },
                    {
                        data: 'prod_hierarchy3',
                        name: 'prod_hierarchy3'
                    },
                    {
                        data: 'prod_hierarchy4',
                        name: 'prod_hierarchy4'
                    },
                    {
                        data: 'manufactur',
                        name: 'manufactur'
                    },
                    {
                        data: 'name_manufactur',
                        name: 'name_manufactur'
                    },
                    {
                        data: 'principle',
                        name: 'principle'
                    },
                    {
                        data: 'name_principle',
                        name: 'name_principle'
                    },
                    {
                        data: 'cust_grp1',
                        name: 'cust_grp1'
                    },
                    {
                        data: 'desc_cust_grp1',
                        name: 'desc_cust_grp1'
                    },
                    {
                        data: 'cust_grp2',
                        name: 'cust_grp2'
                    },
                    {
                        data: 'desc_cust_grp2',
                        name: 'desc_cust_grp2'
                    },
                    {
                        data: 'cust_grp3',
                        name: 'cust_grp3'
                    },
                    {
                        data: 'desc_cust_grp3',
                        name: 'desc_cust_grp3'
                    },
                    {
                        data: 'cust_grp4',
                        name: 'cust_grp4'
                    },
                    {
                        data: 'desc_cust_grp4',
                        name: 'desc_cust_grp4'
                    },
                    {
                        data: 'salesman',
                        name: 'salesman'
                    },
                    {
                        data: 'name_salesman',
                        name: 'name_salesman'
                    },
                    {
                        data: 'order_reason',
                        name: 'order_reason'
                    },
                    {
                        data: 'order_note',
                        name: 'order_note'
                    },
                    {
                        data: 'cancelled_bill_doc',
                        name: 'cancelled_bill_doc'
                    },
                    {
                        data: 'c_bill_doc_creation_date',
                        name: 'c_bill_doc_creation_date'
                    },
                    {
                        data: 'so_number',
                        name: 'so_number'
                    },
                    {
                        data: 'cust_po_no',
                        name: 'cust_po_no'
                    },
                    {
                        data: 'do_number',
                        name: 'do_number'
                    },
                    {
                        data: 'po_number',
                        name: 'po_number'
                    },
                    {
                        data: 'tanggal_po',
                        name: 'tanggal_po'
                    },
                    {
                        data: 'batch',
                        name: 'batch'
                    },
                    {
                        data: 'supplier_batch',
                        name: 'supplier_batch'
                    },
                    {
                        data: 'sled',
                        name: 'sled'
                    },
                    {
                        data: 'remark_ptd2',
                        name: 'remark_ptd2'
                    },
                    {
                        data: 'remark_ptd3',
                        name: 'remark_ptd3'
                    },
                    {
                        data: 'remark_ptd4',
                        name: 'remark_ptd4'
                    },
                    {
                        data: 'nilai_netto',
                        name: 'nilai_netto'
                    },
                    {
                        data: 'nilai_bruto',
                        name: 'nilai_bruto'
                    },
                    {
                        data: 'diskon_phapros',
                        name: 'diskon_phapros'
                    },
                    {
                        data: 'ppn',
                        name: 'ppn'
                    },
                    {
                        data: 'page',
                        name: 'page'
                    },
                    {
                        data: 'dist',
                        name: 'dist'
                    },
                    {
                        data: 'total_bayar',
                        name: 'total_bayar'
                    },
                    {
                        data: 'uuid',
                        name: 'uuid'
                    },
                    {
                        data: 'upload_date',
                        name: 'upload_date'
                    }
                ],
                scrollX: true,
                scrollY: "45vh",
                scrollCollapse: true,
            });
        });

        $(document).ready(function() {
            // Memicu klik pada input file ketika area Dropzone diklik
            $('#dropzoneLikeArea').on('click', function() {
                $('#csvFile').click();
            });

            // Menampilkan nama file yang dipilih
            $('#csvFile').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $('#selected-file-name').text('File terpilih: ' + fileName).removeClass('d-none');
                    $('.dropzone-msg-title, .dropzone-msg-desc').addClass('d-none');
                } else {
                    $('#selected-file-name').addClass('d-none');
                    $('.dropzone-msg-title, .dropzone-msg-desc').removeClass('d-none');
                }
            });

            // Logika untuk menampilkan SweetAlert setelah halaman di-refresh
            @if (session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: "Gagal!",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            @endif
        });
    </script>
@endpush
