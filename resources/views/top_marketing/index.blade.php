@extends('layouts.app', ['title' => 'Data Target Operasional'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data',
        'subtitle' => 'Target Operasional',
        'columns' => [
            'tahun',
            'bulan',
            'divisi',
            'region',
            'pm',
            'pilar',
            'kode phapros',
            'nama produk',
            'satuan',
            'netto',
            'cabang',
            'cabang new',
            'distributor',
            'unit',
            'val nett',
        ],
        'upload' => route('top_marketing.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('top_marketing.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'divisi',
                        name: 'divisi'
                    },
                    {
                        data: 'region',
                        name: 'region'
                    },
                    {
                        data: 'pm',
                        name: 'pm'
                    },
                    {
                        data: 'pilar',
                        name: 'pilar'
                    },
                    {
                        data: 'kode_ph',
                        name: 'kode_ph'
                    },
                    {
                        data: 'nama_prod',
                        name: 'nama_prod'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'netto',
                        name: 'netto'
                    },
                    {
                        data: 'cbg',
                        name: 'cbg'
                    },
                    {
                        data: 'cbg_new',
                        name: 'cbg_new'
                    },
                    {
                        data: 'dist',
                        name: 'dist'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'val_nett',
                        name: 'val_nett'
                    },
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
