<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title-edit">Edit Master <span
                    class="d-block text-muted pt-2 font-size-sm">User</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" class="form" id="formEditUser">
                @csrf
                @method('PUT')
                <input type="hidden" id="user_id_edit" name="id">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="nama_edit">Nama</label>
                        <input id="nama_edit" type="text" class="form-control" readonly placeholder="Nama"
                            name="nama" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                        <label for="username_edit">Username</label>
                        <input id="username_edit" type="text" class="form-control" placeholder="Username"
                            name="username" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label for="email_edit">Email</label>
                        <input id="email_edit" type="text" class="form-control" placeholder="Email" name="email" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-4">
                        <label for="role_edit">Role:</label>
                        <select class="form-control" id="role_edit" name="role">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('role', $role) == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="password_edit">Password <small class="text-muted">(kosongkan jika tidak ingin
                                diubah)</small></label>
                        <input id="password_edit" type="password" class="form-control" placeholder="Password"
                            name="password" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                        <label for="password_confirmation_edit">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation_edit" placeholder="Konfirmasi Password">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2 col-form-label">Active</label>
                    <div class="col-2">
                        <span class="switch switch-sm switch-outline switch-icon switch-primary">
                            <label>
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active_edit"
                                    value="1">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-success font-weight-bold" id="updateBtn">
                Update
            </button>
        </div>
    </div>
</div>
