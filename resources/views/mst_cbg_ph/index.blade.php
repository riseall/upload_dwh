@extends('layouts.app', ['title' => 'Master Cabang PH'])
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Data Master
                            <span class="d-block text-muted pt-2 font-size-lg">Cabang Phapros</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-striped table-hover text-nowrap datatable">
                        <thead class="text-nowrap">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Cabang</th>
                                <th>Region</th>
                                <th>Alamat Cabang</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cbgPH as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $item->nama_cbg }}</td>
                                    <td>{{ $item->region }}</td>
                                    <td>{{ $item->branch_address }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->province }}</td>
                                    <td>{{ $item->postal_code }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-nowrap text-center">
                                        @if ($item->is_active)
                                            <span class="label label-light-success label-inline label-bold">Aktif</span>
                                        @else
                                            <span class="label label-light-danger label-inline label-bold">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center text-center">
                                        {{-- Tombol Aksi --}}
                                        <button class="btn btn-sm btn-warning mr-2 edit-btn"
                                            data-id="{{ $item->id_cbg_ph }}">
                                            <i class="far fa-edit icon-md"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id_cbg_ph }}">
                                            <i class="far fa-trash-alt icon-md"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                <!-- Modal-->
                <div class="modal fade" id="editItemModal" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="editMstitemLabel" aria-hidden="true">
                    @include('mst_cbg_ph.edit')
                </div>
                <!--end::Modal-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $(document).on('click', '.edit-btn', function() {
                var itemId = $(this).data('id');
                let url = '{{ route('mst_cbg_ph.edit', ':itemId') }}'.replace(':itemId', itemId);
                // Ambil data item dari server menggunakan AJAX
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        if (response.status === 200) {
                            // Mengisi form modal dengan data yang diterima dari controller
                            $('#edit_item_id').val(response.cbgPH.id_cbg_ph);
                            $('#nama_cbg').val(response.cbgPH.nama_cbg);
                            $('#region').val(response.cbgPH.region);
                            $('#branch_address').val(response.cbgPH.branch_address);
                            $('#city').val(response.cbgPH.city);
                            $('#province').val(response.cbgPH.province);
                            $('#postal_code').val(response.cbgPH.postal_code);
                            $('#phone_number').val(response.cbgPH.phone_number);
                            $('#email').val(response.cbgPH.email);

                            // Checkbox untuk status aktif
                            if (response.cbgPH.is_active) {
                                $('#is_active').prop('checked', true);
                            } else {
                                $('#is_active').prop('checked', false);
                            }

                            var myModal = new bootstrap.Modal(document.getElementById(
                                'editItemModal'));
                            myModal.show();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengambil data.'
                        });
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#updateBtn').click(function() {
                var itemId = $('#edit_item_id').val();
                var formData = $('#formMstCbgPh').serialize();
                let url = '{{ route('mst_cbg_ph.update', ':itemId') }}'.replace(':itemId', itemId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Notifikasi sukses (kode status 200)
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#editItemModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Ini adalah blok untuk menangani semua error, termasuk validasi

                        // Periksa apakah error adalah validasi (kode status 422)
                        if (xhr.status === 422) {
                            // Ambil pesan error dari respons JSON
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            // Buat daftar pesan error dalam format HTML
                            $.each(errors, function(field, messages) {
                                $.each(messages, function(key, message) {
                                    errorMessage += `<li>${message}</li>`;
                                });
                            });

                            // Tampilkan SweetAlert2 dengan pesan validasi
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                html: `<ul>${errorMessage}</ul>`
                            });
                        } else {
                            // Notifikasi untuk error lainnya (500, 404, dll)
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menyimpan perubahan.'
                            });
                            console.error(xhr.responseText);
                        }
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                var itemId = $(this).data('id');
                let url = '{{ route('mst_cbg_ph.destroy', ':itemId') }}'.replace(':itemId', itemId);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    // Periksa properti `isConfirmed` atau `value`
                    if (result.isConfirmed || result.value) {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response.message
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus data.'
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {

                    }
                });
            });
        });
    </script>
@endpush
