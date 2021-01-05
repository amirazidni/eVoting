<?= $this->extend('Layout/Template'); ?>

<?= $this->section('content'); ?>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <div id="voter"></div>
                </h3>
                <p>Jumlah Pemilih</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-person-add"></i>
            </div>
            <a href="Datapem" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <div id="candidate"></div>
                </h3>
                <p>Jumlah Calon</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            <a href="Datacal" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <div id="voteCount"></div>
                </h3>

                <p>Suara Masuk</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-checkbox"></i>
            </div>
            <a href="Hasilpilih" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <div id="cleanVote"></div>
                </h3>

                <p>Suara Bersih</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-checkbox"></i>
            </div>
            <a href="Hasilpilih" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <div id="unused"></div>
                </h3>
                <p>Suara Belum Digunakan</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-walk"></i>
            </div>
            <a href="Datapem" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <div id="recap"></div>
                </h3>
                <p>Suara Rekapitulasi</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-walk"></i>
            </div>
            <a href="Datapem" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>