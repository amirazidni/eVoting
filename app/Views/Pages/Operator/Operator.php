<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="row mb-2">
            <div class="col-12 d-flex">
                <button type="button" class="ml-auto btn btn-primary" data-toggle="modal" data-target="#addoperator"><i class="fa fa-plus"></i> Tambah Operator</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operators as $item) : ?>
                            <tr>
                                <td><?= $item['username']; ?> </td>
                                <td><?= $item['phone']; ?></td>
                                <td>
                                    <button class="btn-update btn btn-primary" data-toggle="modal" data-target="#updateoperator" data-id="<?= $item['id'] ?>" data-username="<?= $item['username'] ?>" data-phone="<?= $item['phone'] ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn-delete btn btn-danger" data-toggle="modal" data-target="#deleteConfirm" data-id="<?= $item['id'] ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Operator -->
<div class="modal fade" id="addoperator" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Operator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('operator/add') ?>" method="post">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Username</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="username" placeholder="Username" required class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Phone</label></div>
                        <div class="col-12 col-md-9">
                            <input type="tel" name="phone" placeholder="phone (+628953...)" required class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Password</label></div>
                        <div class="col-12 col-md-9">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Operator -->
<div class="modal fade" id="updateoperator" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Operator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?= base_url('operator/update'); ?>" method="post">
                <div class="modal-body">
                    <input type="text" name="id" id="updateOperatorId" hidden>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="disabled-input" class=" form-control-label">Username</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input id="updateOperatorUsername" type="text" name="username" placeholder="Username" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Phone</label></div>
                        <div class="col-12 col-md-9">
                            <input id="updateOperatorPhone" type="tel" name="phone" placeholder="Phone" required class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Passowrd</label></div>
                        <div class="col-12 col-md-9">
                            <input id="updateOperatorPass" type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Ubah" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Operator -->
<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin menghapus?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="<?= base_url('operator/delete'); ?>">
                    <input type="text" id="deleteOperatorId" name="id" hidden>
                    <input type="submit" class="btn btn-primary" value="Ya">
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- SCRIPT -->
<?= $this->section('script'); ?>

<script>
    $('.btn-update').on('click', function() {
        let target = $(this)
        let id = target.data('id')
        let username = target.data('username')
        let phone = target.data('phone')

        $('#updateOperatorId').val(id)
        $('#updateOperatorUsername').val(username)
        $('#updateOperatorPhone').val(phone)
    })

    $('.btn-delete').click('click', function() {
        $('#deleteOperatorId').val($(this).data('id'))
    })
</script>

<?= $this->endSection(); ?>