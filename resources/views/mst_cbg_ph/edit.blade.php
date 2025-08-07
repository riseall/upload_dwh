<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editMstCbgDistLabel">Edit Master <span
                    class="d-block text-muted pt-2 font-size-sm">Cabang Phapros</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" class="form" id="formMstCbgPh">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_item_id" name="id">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="id_cbg_ph">ID Cabang Phapros</label>
                        <input id="id_cbg_ph" type="text" class="form-control" readonly placeholder="ID Cabang PH"
                            name="id_cbg_ph" />
                    </div>
                    <div class="col-lg-6">
                        <label for="nama_cbg">Nama Cabang</label>
                        <input id="nama_cbg" type="text" class="form-control" placeholder="Nama Cabang"
                            name="nama_cbg" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="branch_address">Alamat Cabang</label>
                    <textarea id="branch_address" class="form-control" rows="3" name="branch_address"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="city">Kota</label>
                        <input id="city" type="text" class="form-control" placeholder="Kota" name="city" />
                    </div>
                    <div class="col-lg-4">
                        <label for="province">Provinsi</label>
                        <input id="province" type="text" class="form-control" placeholder="Provinsi"
                            name="province" />
                    </div>
                    <div class="col-lg-4">
                        <label for="postal_code">Kode Pos</label>
                        <input id="postal_code" type="text" class="form-control" placeholder="Kode Pos"
                            name="postal_code" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="phone_number">No. Telepon</label>
                        <input id="phone_number" type="text" class="form-control" placeholder="No. Telepon"
                            name="phone_number" />
                    </div>
                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" placeholder="Email" name="email" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Active</label>
                    <div class="col-2">
                        <span class="switch switch-sm switch-outline switch-icon switch-primary">
                            <label>
                                <input type="checkbox" id="is_active" name="is_active" value="1" />
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-primary font-weight-bold" id="updateBtn">
                Save Changes
            </button>
        </div>
    </div>
</div>
