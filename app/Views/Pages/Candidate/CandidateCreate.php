<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<?php

$url = 'candidate/createAction';
$name = '';
$votetype = '';
$candidateOrder = '';
$description = '';

if ($update) {
    $url = 'candidate/updateAction?candidateId=' . $candidate['id'];
    $name = $candidate['name'];
    $votetype = $candidate['votetype'];
    $candidateOrder = $candidate['candidateOrder'];
    $description = $candidate['description'];
}

?>

<div class="row">
    <div class="col-12">
        <?= form_open_multipart($url); ?>
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="candidateOrder" class=" form-control-label">Nomor Urut</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input value="<?= $candidateOrder ?>" type="number" id="candidateOrder" name="candidateOrder" placeholder="Nomor Urut" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="name" class=" form-control-label">Nama Calon</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea rows="3" type="text" id="name" name="name" placeholder="Nama" class="form-control" required><?= $name ?></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="desc" class=" form-control-label">Deskripsi</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea id="desc" rows="4" name="description" placeholder="Deskripsi" class="form-control" required><?= $description ?></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="voteType" class="form-control-label">Tipe Suara</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select id="voteType" name="voteType" style="width: 100%" class="px-2 py-2" required>
                            <option disabled selected value> -- select an option -- </option>
                            <?php foreach ($votetypes as $item) { ?>
                                <option value="<?= $item['id'] ?>" <?= $item['id'] == $votetype ? 'selected' : '' ?>><?= $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="photo" class="form-control-label">Foto</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input class="form-control-file" type="file" name="photo" accept="image/*" id="photo" <?= $update ? '' : 'required' ?>>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="float-right btn btn-success">
                    <i class="fa fa-plus"></i>
                    <?= $update ? 'Update' : 'Tambah' ?> Calon
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- SCRIPT -->
<?= $this->section('script'); ?>



<?= $this->endSection(); ?>