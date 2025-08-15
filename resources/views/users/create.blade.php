<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title">Create Master <span
                    class="d-block text-muted pt-2 font-size-sm">User</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" class="form" id="formCreateUser">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="nama">Nama</label>
                        <input id="nama" type="text" class="form-control" placeholder="Nama" name="nama" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" placeholder="Username"
                            name="username" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" placeholder="Email" name="email" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-4">
                        <label for="role">Role:</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option> {{ $role->name }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" placeholder="Password"
                            name="password" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-lg-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Konfirmasi Password">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-2 col-form-label">Active</label>
                    <div class="col-2">
                        <span class="switch switch-sm switch-outline switch-icon switch-primary">
                            <label>
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                    id="is_active_{{ $user->id }}" value="1"
                                    {{ old('is_active', $user->is_active ?? 1) ? 'checked' : '' }}>
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
            <button type="button" class="btn btn-success font-weight-bold" id="createUser">
                Save
            </button>
        </div>
    </div>
</div>
