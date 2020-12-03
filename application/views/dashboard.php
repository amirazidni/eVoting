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

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <h2 class="text-dark">Dashboard</h2>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <div class="info">
              <a href="" data-toggle="modal" data-target="#konfirmkeluar" class="d-block"> <i class="fa fa-power-off"></i> Log out</a>
            </div>

            <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a> -->
          </li>

        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="Dasbor" class="brand-link">
          <img src="<?= base_url() ?>assets/dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Voting</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="Dasbor" class="nav-link active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Datapem" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Pemilih
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Datacal" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Data Calon
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Hasilpilih" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Export PDF
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Datapeng" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Pengawas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="datarekap" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>
                    Rekap Data
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#konfirmkeluar" data-toggle="modal" class="nav-link">
                  <i class="nav-icon fas fa-power-off"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>


            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">


            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
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
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
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

              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
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

              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
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

              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
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

              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
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

              <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <!-- PIE CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-cog fa-spin fa-fw"></i>
                      Live Statistik Suara Masuk
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>

                    </div>
                  </div>
                  <div class="card-body ">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px;  max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.PIE card -->

              </section>
              <!-- /.Left col -->
              <!-- right col (We are only adding the ID to make the widgets sortable)-->
              <section class="col-lg-5 connectedSortable">
                <div class="card card-warning collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-cog fa-spin fa-fw"></i>

                      Pengolahan Lanjutan
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <a onClick="return confirm('Ini akan menghapus semua suara masuk. Yakin?')" href="#" class="btn btn-danger"><i class="fas fa-undo"></i> Reset Suara Masuk</a>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              </section>
              <!-- right col -->
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>

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

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.0.5
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
  </body>

  </html>
  <script type="text/javascript">
    let voter = $('#voter')
    let candidate = $('#candidate')
    let recap = $('#recap')
    let unused = $('#unused')
    let voteCount = $('#voteCount')
    let cleanVote = $('#cleanVote')

    /* ChartJS */
    let pieConfig = {
      type: 'pie',
      data: {
        datasets: [{
          data: [0, 0],
          backgroundColor: ['#00a65a', '#ffc107'],
        }],
        labels: ['Suara Masuk', 'Suara Belum Digunakan'],
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
      }
    }

    $(document).ready(() => {
      let ctx = document.getElementById('pieChart').getContext('2d')
      let piechart = new Chart(ctx, pieConfig)
      let counting = 5

      setInterval(() => {
        $.getJSON("<?= base_url('dashboard/updateRealtime') ?>", (data) => {
          let recapNum = 0
          for (const item of data.recapVote) {
            recapNum += Number(item.count)
          }

          voter.text(data.voterCount)
          candidate.text(data.candidateCount)
          voteCount.text(data.voteCount)
          unused.text(data.voterCount - data.voteCount)
          recap.text(recapNum)
          cleanVote.text(data.voteCount - recapNum)

          if (counting++ >= 5) {
            // Update Pie Chart
            pieConfig.data.datasets[0].data[0] = data.voteCount
            pieConfig.data.datasets[0].data[1] = data.voterCount - data.voteCount
            piechart.update();

            counting = 0
          }
        })
      }, 5000)
    })
  </script>