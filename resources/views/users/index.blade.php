@extends('layouts.app', ['title' => 'Users'])
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Data Master
                            <span class="d-block text-muted pt-2 font-size-lg">Users</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <button class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#modalCreateUser">
                            <span class="svg-icon svg-icon-md">
                                <i class="fas fa-user-plus icon-md"></i>
                            </span>Add User</button>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-striped table-hover text-nowrap datatable"
                        id="users-table">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center" style="width: 5%">{{ $loop->iteration }}.</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                            <span
                                                class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">{{ $role }}
                                        @endforeach
                                    </td>
                                    <td class="text-nowrap text-center">
                                        @if ($user->is_active)
                                            <span
                                                class="label label-lg label-light-success label-inline label-bold">Aktif</span>
                                        @else
                                            <span class="label label-lg label-light-danger label-inline label-bold">Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center text-center">
                                        {{-- Tombol Aksi --}}
                                        <button class="btn btn-sm btn-warning mr-2 edit-btn" data-id="{{ $user->id }}">
                                            <i class="far fa-edit icon-md"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                {{-- Modal Create --}}
                <div class="modal fade" id="modalCreateUser" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="modal-title" aria-hidden="true">
                    @include('users.create')
                </div>
                {{-- end::Modal --}}
                <!-- Modal Edit-->
                <div class="modal fade" id="modalEditUser" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="modal-title-edit" aria-hidden="true">
                    @include('users.edit')
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
            // Event listener saat modal CREATE ditutup
            $('#modalCreateUser').on('hidden.bs.modal', function() {
                $('#formCreateUser')[0].reset();
                $('#formCreateUser').find('.is-invalid').removeClass('is-invalid');
                $('#formCreateUser').find('.invalid-feedback').html('');
            });

            // Event listener saat modal EDIT ditutup
            $('#modalEditUser').on('hidden.bs.modal', function() {
                $('#formEditUser')[0].reset();
            });

            // Create Data User
            $('#createUser').on('click', function(e) {
                e.preventDefault();

                // Bersihkan pesan error dan kelas error sebelumnya sebelum mengirim ulang
                $('#formCreateUser').find('.is-invalid').removeClass('is-invalid');
                $('#formCreateUser').find('.invalid-feedback').html('');

                // mengambil data dari form
                let formData = $('#formCreateUser').serialize();
                let url = "{{ route('users.store') }}";

                // mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#modalCreateUser').modal('hide');

                        $('#formCreateUser')[0].reset();

                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            // Iterasi setiap error dan tampilkan di bawah input
                            $.each(errors, function(key, value) {
                                let inputField = $(`#${key}`);
                                if (inputField.length) {
                                    inputField.addClass('is-invalid');
                                    inputField.next('.invalid-feedback').html(value[0]);
                                }
                            });
                        } else {
                            // Jika ada error lain
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data.',
                            });
                        }
                    }
                })
            });

            // Ketika tombol edit diklik
            $('#users-table').on('click', '.edit-btn', function() {
                let userId = $(this).data('id');
                let url = `{{ url('users') }}/${userId}/edit`;

                // Ambil data item dari server menggunakan AJAX
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {

                        // Mengisi form modal dengan data yang diterima dari controller
                        $('#user_id_edit').val(response.user.id);
                        $('#nama_edit').val(response.user.name);
                        $('#username_edit').val(response.user.username);
                        $('#email_edit').val(response.user.email);
                        $('#role_edit').val(response.role);

                        // Checkbox untuk status aktif
                        $('#is_active_edit').prop('checked', response.user.is_active);

                        $('#modalEditUser').modal('show');

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal mengambil data user.',
                        });
                        console.error(xhr.responseText);
                    }
                });
            });

            // Update Data User
            $('#updateBtn').on('click', function(e) {
                e.preventDefault();

                let userId = $('#user_id_edit').val();
                let formData = $('#formEditUser').serialize();
                let url = `{{ url('users') }}/${userId}`;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalEditUser').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Menyesuaikan ID input form edit
                                let inputField = $(`#${key}_edit`);
                                if (inputField.length) {
                                    inputField.addClass('is-invalid');
                                    inputField.next('.invalid-feedback').html(value[0]);
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat memperbarui data.',
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
