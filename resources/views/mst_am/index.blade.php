@extends('layouts.app', ['title' => 'Master Coverage AM'])
@section('content')
    @include('layouts.partial.datatables', [
        'title' => 'Data Master',
        'subtitle' => 'Coverage AM',
        'columns' => ['nik am', 'nik sam', 'nama am', 'pilar', 'subdiv'],
        'upload' => route('mst_am.store'),
    ])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.datats').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mst_am.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'am_nik',
                        name: 'am_nik'
                    },
                    {
                        data: 'sam_nik',
                        name: 'sam_nik'
                    },
                    {
                        data: 'nama_am',
                        name: 'nama_am'
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
