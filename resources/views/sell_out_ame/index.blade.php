@extends('layouts.app', ['title' => 'Selling Out AME'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Selling Out',
        'subtitle' => 'Apotek Menjangan Enam (AME)',
        'columns' => [
            'distributor',
            'nacabdist',
            'segment mi',
            'segment',
            'cust id',
            'pnamlang',
            'alamat',
            'kota',
            'faktur',
            'nabarmi',
            'sled',
            'sub sektor',
            'satuan',
            'supplier batch',
            'unit',
            'bruto',
            'netto peha',
            'hpc',
            'bulan',
            'pilar',
            'kodbarpab',
            'tanggal',
            'minggu',
            'cabang',
            'segmen baru',
            'divisi',
            'pilar baru',
            'regional',
            'nama pm',
            'segment khusus',
            'nama mr sr',
            'id ter',
            'nip mr sr',
            'nama am',
            'nama sam',
            'wilayah',
            'disc',
            'kelompok disc',
            'batch',
        ],
        'upload' => route('sell_out_ame.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sell_out_ame.data') }}",
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
                        data: 'distributor',
                        name: 'distributor'
                    },
                    {
                        data: 'nacabdist',
                        name: 'nacabdist'
                    },
                    {
                        data: 'segment_mi',
                        name: 'segment_mi'
                    },
                    {
                        data: 'segment',
                        name: 'segment'
                    },
                    {
                        data: 'cust_id',
                        name: 'cust_id'
                    },
                    {
                        data: 'pnamlang',
                        name: 'pnamlang'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'kota',
                        name: 'kota'
                    },
                    {
                        data: 'faktur',
                        name: 'faktur'
                    },
                    {
                        data: 'nabarmi',
                        name: 'nabarmi'
                    },
                    {
                        data: 'sled',
                        name: 'sled'
                    },
                    {
                        data: 'sub_sektor',
                        name: 'sub_sektor'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'supplier_batch',
                        name: 'supplier_batch'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'bruto',
                        name: 'bruto'
                    },
                    {
                        data: 'netto_peha',
                        name: 'netto_peha'
                    },
                    {
                        data: 'hpc',
                        name: 'hpc'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'pilar',
                        name: 'pilar'
                    },
                    {
                        data: 'kodbarpab',
                        name: 'kodbarpab'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'minggu',
                        name: 'minggu'
                    },
                    {
                        data: 'cabang',
                        name: 'cabang'
                    },
                    {
                        data: 'segmen_baru',
                        name: 'segmen_baru'
                    },
                    {
                        data: 'divisi',
                        name: 'divisi'
                    },
                    {
                        data: 'pilar_baru',
                        name: 'pilar_baru'
                    },
                    {
                        data: 'regional',
                        name: 'regional'
                    },
                    {
                        data: 'nama_pm',
                        name: 'nama_pm'
                    },
                    {
                        data: 'segment_khusus',
                        name: 'segment_khusus'
                    },
                    {
                        data: 'nama_mr_sr',
                        name: 'nama_mr_sr'
                    },
                    {
                        data: 'id_ter',
                        name: 'id_ter'
                    },
                    {
                        data: 'nip_mr_sr',
                        name: 'nip_mr_sr'
                    },
                    {
                        data: 'nama_am',
                        name: 'nama_am'
                    },
                    {
                        data: 'nama_sam',
                        name: 'nama_sam'
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah'
                    },
                    {
                        data: 'disc',
                        name: 'disc'
                    },
                    {
                        data: 'kelompok_disc',
                        name: 'kelompok_disc'
                    },
                    {
                        data: 'batch',
                        name: 'batch'
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
