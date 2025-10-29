@extends('layouts.app', ['title' => 'Master Cabang Distributor'])
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Data Master
                            <span class="d-block text-muted pt-2 font-size-lg">Cabang Distributor</span>
                        </h3>
                    </div>
                    {{-- <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="#" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>New Record</a>
                        <!--end::Button-->
                    </div> --}}
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-striped table-hover text-nowrap datatable">
                        <thead class="text-nowrap">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Cabang PH ID</th>
                                <th>Kode Cabang Distributor</th>
                                <th>Nama Cabang</th>
                                <th>Alamat Cabang</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Distributor</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cbgDists as $cbgDist)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $cbgDist->id_cbg_ph }}</td>
                                    <td>{{ $cbgDist->kode_cbg_dist }}</td>
                                    <td>{{ $cbgDist->nama_cbg }}</td>
                                    <td>{{ $cbgDist->branch_address }}</td>
                                    <td>{{ $cbgDist->city }}</td>
                                    <td>{{ $cbgDist->province }}</td>
                                    <td>{{ $cbgDist->postal_code }}</td>
                                    <td>{{ $cbgDist->phone_number }}</td>
                                    <td>{{ $cbgDist->email }}</td>
                                    <td>{{ $cbgDist->dist }}</td>
                                    <td class="text-nowrap text-center">
                                        @if ($cbgDist->is_active)
                                            <span class="label label-light-success label-inline label-bold">Aktif</span>
                                        @else
                                            <span class="label label-light-danger label-inline label-bold">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center text-center">
                                        {{-- Tombol Aksi --}}
                                        <button class="btn btn-sm btn-warning mr-2 edit-btn"
                                            data-id="{{ $cbgDist->id_cbg_dist }}">
                                            <i class="far fa-edit icon-md"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $cbgDist->id_cbg_dist }}">
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
                    aria-labelledby="editMstCbgDistLabel" aria-hidden="true">
                    @include('mst_cbg_dist.edit')
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
                let itemId = $(this).data('id');
                let url = '{{ route('mst_cbg_dist.edit', ':itemId') }}'.replace(':itemId', itemId);
                // Ambil data item dari server menggunakan AJAX

                console.log(itemId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 200) {
                            // Mengisi form modal dengan data yang diterima dari controller
                            $('#edit_item_id').val(response.cbgDist.id_cbg_dist);
                            $('#id_cbg_ph').val(response.cbgDist.id_cbg_ph);
                            $('#kode_cbg_dist').val(response.cbgDist.kode_cbg_dist);
                            $('#nama_cbg').val(response.cbgDist.nama_cbg);
                            $('#branch_address').val(response.cbgDist.branch_address);
                            $('#city').val(response.cbgDist.city);
                            $('#province').val(response.cbgDist.province);
                            $('#postal_code').val(response.cbgDist.postal_code);
                            $('#phone_number').val(response.cbgDist.phone_number);
                            $('#email').val(response.cbgDist.email);
                            $('#dist').val(response.cbgDist.dist);

                            // Checkbox untuk status aktif
                            if (response.cbgDist.is_active) {
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
                var formData = $('#formMstCbgDist').serialize();
                let url = '{{ route('mst_cbg_dist.update', ':itemId') }}'.replace(':itemId', itemId);

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
                let url = '{{ route('mst_cbg_dist.destroy', ':itemId') }}'.replace(':itemId', itemId);

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
