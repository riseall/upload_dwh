@extends('layouts.app', ['title' => 'Master Customer Distributor PH'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Master',
        'subtitle' => 'Customer Distributor Phaspros',
        'columns' => [
            'ID Outlet',
            'ID Cabang Distributor',
            'ID Outlet Cabang',
            'Nama Outlet',
            'Alamat 1',
            'Alamat 2',
            'Alamat 3',
            'No. Telepon',
            'Segment',
            'Pasar',
            'Distributor',
        ],
        'upload' => route('mst_cust_dist.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mst_cust_dist.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_outlet',
                        name: 'id_outlet'
                    },
                    {
                        data: 'id_cbg_dist',
                        name: 'id_cbg_dist'
                    },
                    {
                        data: 'id_outlet_cbg',
                        name: 'id_outlet_cbg'
                    },
                    {
                        data: 'nama_outlet',
                        name: 'nama_outlet'
                    },
                    {
                        data: 'alamat_1',
                        name: 'alamat_1'
                    },
                    {
                        data: 'alamat_2',
                        name: 'alamat_2'
                    },
                    {
                        data: 'alamat_3',
                        name: 'alamat_3'
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'segment',
                        name: 'segment'
                    },
                    {
                        data: 'pasar',
                        name: 'pasar'
                    },
                    {
                        data: 'dist',
                        name: 'dist'
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
