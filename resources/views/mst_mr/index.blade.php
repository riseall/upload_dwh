@extends('layouts.app', ['title' => 'Master MR'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Master',
        'subtitle' => 'Coverage MR',
        'columns' => ['nik mr', 'nik am', 'nama mr', 'pilar', 'id_cbg', 'subdiv'],
        'upload' => route('mst_mr.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mst_mr.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'mr_nik',
                        name: 'mr_nik'
                    },
                    {
                        data: 'am_nik',
                        name: 'am_nik'
                    },
                    {
                        data: 'nama_mr',
                        name: 'nama_mr'
                    },
                    {
                        data: 'pilar',
                        name: 'pilar'
                    },
                    {
                        data: 'id_cbg',
                        name: 'id_cbg'
                    },
                    {
                        data: 'subdiv',
                        name: 'subdiv'
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
