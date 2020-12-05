<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Pemilihan Online</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>

    <!-- Main content -->
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-4"> Jumlah Pemilih : <?= $voterCount; ?> </div>
                    <div class="col-4 text-center"> Sudah Memilih : <?= $total; ?></div>
                    <div class="col-4 text-right"> Belum Memilih : <?= ($voterCount - $total); ?></div>
                </div>
            </div>
            <hr>

            <div class="row">
                <?php foreach ($candidates as $candidate) : ?>

                    <div class="col-md-4">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('upload/' . $candidate['foto']) ?>">
                                        </a>
                                        <div class="media-body">
                                            <h2 class="text-light display-6"><?php echo $candidate['nama1']; ?> &</h2>
                                            <h2 class="text-light display-6"><?php echo $candidate['nama2']; ?></h2>
                                            <p>Calon No <?php echo $candidate['nomorurut']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <center>
                                            <h1><br><?php echo $candidate['votes']; ?> Suara</h1>
                                            <h3><?= number_format(($candidate['votes'] / $total) * 100, 2, '.', '') ?> %</h3>
                                            <br><br>
                                        </center>
                                    </li>
                                </ul>
                            </section>
                        </aside>
                    </div>

                <?php endforeach; ?>
            </div>

        </div> <!-- .content -->
        <div class="clearfix"></div>
        </div><!-- /.container-fluid -->
    </section>

    <!--Modal Keluar -->
    <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <form action="<?= base_url('index.php/welcome_admin/logout'); ?>">
                        <input type="submit" class="btn btn-primary" value="Ya">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Grafik -->
    <div class="modal fade" id="lihatgrafik" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="largeModalLabel">
                        <center>Hasil Pemilihan</center>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <h4 class="mb-3"> </h4>
                                <canvas id="doughutChart" height="300" width="601" class="chartjs-render-monitor" style="display: block; width: 601px; height: 300px;"></canvas>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>