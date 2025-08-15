@extends('layouts.app', ['title' => 'Master RM'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Master',
        'subtitle' => 'Coverage RM',
        'columns' => ['nik rm', 'nik gm', 'nama rm', 'pilar', 'subdiv'],
        'upload' => route('mst_rm.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mst_rm.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rm_nik',
                        name: 'rm_nik'
                    },
                    {
                        data: 'gm_nik',
                        name: 'gm_nik'
                    },
                    {
                        data: 'nama_rm',
                        name: 'nama_rm'
                    },
                    {
                        data: 'pilar',
                        name: 'pilar'
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
