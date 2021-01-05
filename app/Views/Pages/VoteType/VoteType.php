<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="row mb-2">
            <div class="col-12 d-flex">
                <button type="button" class="ml-auto btn btn-primary" data-toggle="modal" data-target="#addVoteType">
                    <i class="fa fa-plus"></i>
                    Tambah Tipe Surat Suara
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="w-100 table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipe Suara</th>
                            <th>Nama Tipe Suara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($votetypes as $item) { ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['type'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td>
                                    <button class="btn-update btn btn-primary" data-toggle="modal" data-target="#updateVoteTypeForm" data-id="<?= $item['id'] ?>" data-vote-type="<?= $item['type'] ?>" data-vote-type-name="<?= $item['name'] ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn-delete btn btn-danger" data-toggle="modal" data-target="#deleteConfirm" data-id="<?= $item['id'] ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Vote Type -->
<div class="modal fade" id="addVoteType" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Tambah Tipe Suara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('voteType/add') ?>" method="post">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="voteType" class=" form-control-label">Tipe Suara</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="voteType" id="voteType" placeholder="Vote Type" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="voteTypeName" class=" form-control-label">Nama Tipe Suara</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="voteTypeName" id="voteTypeName" placeholder="Nama Tipe Vote" class="form-control" required>
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

<!-- Update VoteTYpe -->
<div class="modal fade" id="updateVoteTypeForm" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Vote Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?= base_url('voteType/update'); ?>" method="post">
                <div class="modal-body">
                    <input type="text" name="id" id="updateVoteTypeId" hidden>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="voteType" class=" form-control-label">Tipe Suara</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="voteType" id="updateVoteType" placeholder="Vote Type" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="voteTypeName" class=" form-control-label">Nama Tipe Suara</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="voteTypeName" id="updateVoteTypeName" placeholder="Nama Tipe Vote" class="form-control" required>
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

<!-- Delete Vote Type -->
<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin menghapus?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="<?= base_url('voteType/delete'); ?>">
                    <input type="text" id="deleteVoteTypeId" name="id" hidden>
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
    $(document).ready(() => {
        $(".table").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            responsive: true,
            processing: true,
            serverSide: false,
        })
    })

    $('.btn-update').on('click', function() {
        let target = $(this)
        let id = target.data('id')
        let voteType = target.data('vote-type')
        let voteTypeName = target.data('vote-type-name')

        $('#updateVoteTypeId').val(id)
        $('#updateVoteType').val(voteType)
        $('#updateVoteTypeName').val(voteTypeName)
    })

    $('.btn-delete').click('click', function() {
        $('#deleteVoteTypeId').val($(this).data('id'))
    })
</script>

<?= $this->endSection(); ?>