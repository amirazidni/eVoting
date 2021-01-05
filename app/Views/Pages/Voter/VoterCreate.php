<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<?php

$url = 'voter/createAction';
$nim = '';
$name = '';
$class = '';
$study = '';
$major = '';
$faculty = '';

if ($update) {
    $url = 'voter/updateAction?voterId=' . $voter['id'];
    $nim = $voter['nim'];
    $name = $voter['name'];
    $class = $voter['class'];
    $study = $voter['studyprogram'];
    $major = $voter['major'];
    $faculty = $voter['faculty'];
}

?>

<div class="row">
    <div class="col-12">
        <form action="<?= base_url($url) ?>" method="post">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="nim" class=" form-control-label">NIM</label></div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $nim ?>" type="text" id="nim" name="nim" placeholder="NIM" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password" class=" form-control-label">Password</label></div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="password" name="password" placeholder="password" class="form-control" <?= $update ? '' : 'required' ?>>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="name" class=" form-control-label">Nama Pemilih</label></div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $name ?>" type="text" id="name" name="name" placeholder="Nama" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="class" class=" form-control-label">Kelas</label></div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $class ?>" type="text" id="class" name="class" placeholder="kelas" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="study" class="form-control-label">Program Studi</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $study ?>" type="text" id="study" name="studyprogram" placeholder="Program Studi" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="major" class="form-control-label">Jurusan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $major ?>" type="text" id="major" name="major" placeholder="Jurusan" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="faculty" class="form-control-label">Fakultas</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input value="<?= $faculty ?>" type="text" id="faculty" name="faculty" placeholder="Fakultas" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="card mx-3">
                    <div class="card-header">
                        <h3>Surat Suara</h3>
                    </div>
                    <div class="card-body">
                        <?php

                        $items = [
                            "Pemilihan Partai",
                            "Pemilihan Presiden",
                            "Pemilihan Dema Fakultas",
                            "Pemilihan HMJ",
                            "Pemilihan HMPS",
                        ];

                        foreach ($items as $key => $itemLabel) { ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="<?= $itemLabel ?>" class="form-control-label"><?= $itemLabel ?></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select id="<?= $itemLabel ?>" name="<?= "type" . $key ?>" style="width: 100%" class="px-2 py-2" required>
                                        <option disabled selected value> -- select an option -- </option>
                                        <?php foreach ($votetypes as $item) { ?>
                                            <option value="<?= $item['id'] ?>" <?= $voterType[$key]['votetypeId'] == $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="float-right btn btn-success">
                        <i class="fa fa-plus"></i>
                        <?= $update ? 'Update' : 'Tambah' ?> Pemilih
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<!-- SCRIPT -->
<?= $this->section('script'); ?>



<?= $this->endSection(); ?>