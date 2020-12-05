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

    <!-- Header-->
    <div class="content pb-0">




        <h1>Rekapitulasi</h1>
        <?php $nototal = 0;
        $belummemilih = 0;
        $sudahmemilih = 0;
        $sudahaktivasi = 0;
        $belumaktivasi = 0;
        $sudahaktivasibelummilih = 0;
        foreach ($datapemilih->result_array() as $j) :
            $id = $j['id'];
            $suara = $j['suara'];
            $aktivasi = $j['aktivasi'];
            if ($suara != 0) {
                $sudahmemilih++;
            }
            if ($suara == 0) {
                $belummemilih++;
            }
            if ($aktivasi != 0) {
                $sudahaktivasi++;
            }
            if ($aktivasi == 0) {
                $belumaktivasi++;
            }
            if ($suara == 0 && $aktivasi != 0) {
                $sudahaktivasibelummilih++;
            };
            $nototal++;
        endforeach;

        ?>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-4"> Jumlah Pemilih : <?php echo $nototal; ?> <br> Sudah aktivasi belum memilih : <?php echo $sudahaktivasibelummilih; ?> </div>
                <div class="col-4 text-center"> Sudah Memilih : <?php echo $sudahmemilih; ?><br>Sudah Aktivasi : <?php echo $sudahaktivasi; ?></div>
                <div class="col-4 text-right"> Belum Memilih : <?php echo $belummemilih; ?><br>Belum Aktivasi : <?php echo $belumaktivasi; ?></div>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php $no = 1;
            foreach ($data->result_array() as $i) :
                $id = $i['id'];
                $visi = $i['visi'];
                $misi = $i['misi'];
                $nama1 = $i['nama1'];
                $nama2 = $i['nama2'];
                $foto = $i['foto'];
                $i['vote'] = count($this->db->get_where('pemilih', ['suara' => $id])->result_array());
                $vote = $i['vote'];
            ?>
                <div class="col-md-4">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <form action="<?= base_url('index.php/form/pilih/' . $id . ''); ?>">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <h3 class="text-light tex display-6"><?= $no . '. ' . $nama1; ?> &</h3>
                                        &nbsp<h3 class="text-light display-6"> <?= $nama2; ?></h3>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <center>
                                            <h1>
                                                <img class="align-self-center" style="width:240px; height:300px;" alt="" src="<?= base_url('upload/' . $foto) ?>">
                                            </h1>
                                        </center><br>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <center>
                                                    <h1><br><?= $vote; ?> Suara</h1>
                                                    <h3><?php $persen = ($vote / $nototal) * 100;
                                                        echo $persen; ?> %</h3>
                                                    <br><br>
                                                </center>
                                            </li>
                                        </ul>
                                        </center>
                                    </li>
                                </ul>
                            </form>
                        </section>
                    </aside>
                </div>
            <?php $no++;
            endforeach; ?>
        </div>
    </div> <!-- .content -->
    <div class="clearfix"></div>


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
    <br>
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-right">
                    Copyright &copy; JoSystem2018
                </div>
            </div>
        </div>
    </footer>

    </div><!-- /#right-panel -->



    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataku').DataTable();
        });
    </script>
    <script type="text/javascript">
        window.print();
    </script>

    <div id="container">



    </div>



</body>

</html>