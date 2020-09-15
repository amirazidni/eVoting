<!DOCTYPE html>
<html>
<head>
<?php
    include "../../api/config/database.php";
    include "../cek-admin.php";
?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Pemilihan Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <h2 class="text-dark">Rekapitulasi</h2>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <div class="info">
        <a href="../logout.php" class="d-block"> <i class="fa fa-power-off"></i> Log out</a>
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
    <a href="#" class="brand-link">
      <img src="../../dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
            </li>
          
          <li class="nav-item">
            <a href="data-pemilih.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Pemilih
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="data-calon.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data Calon
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="rekapitulasi.php" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Rekapitulasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <!-- kosong -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7">
            <!-- Table -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Statistik Suara</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama Calon</th>
                      <th colspan="2">Statistik Suara</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include_once "../../api/config/database.php";
                      $query = mysqli_query($kon, "SELECT * FROM calon order by nomor_urut ASC")or die(mysqli_error($kon));
                      $query2 = mysqli_query($kon, "SELECT * FROM pilihan")or die(mysqli_error($kon));
                      $jmlh = mysqli_num_rows( $query2);
                      while($hasil = mysqli_fetch_array($query)){
                        if($jmlh>0){
                          $persen = number_format(($hasil['vote']/$jmlh)*100,2);
                        } else {
                            $persen = 0;
                        }
                        ?>
                          <tr>
                            <td id="nomor_urut"><?php echo $hasil['nomor_urut']; ?></td>
                            <td id="nama"><?php echo $hasil['nama1']." - ".$hasil['nama2']; ?></td>
                            <td style="width: 50%">
                              <div class="progress progress-xs">
                                <div id="prosentase" class="progress-bar " style="width: <?php echo $persen; ?>%"></div>
                              </div>
                            </td>
                            <td style="width: 20px"><span class="badge bg-success"><?php echo $persen; ?>%</span></td>
                          </tr>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body ">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.PIE card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-5">
            

            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

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
                  <div class="col-sm-4">
                  <a data-toggle="modal" data-target="#unduh-hasil" class="btn btn-success"><i class="fa fa-download"></i> Unduh </a>
                  </div>
                  <div class="col-sm-4">
                  <a class="btn btn-info" data-toggle="modal" data-target="#unggah-hasil"><i class="fa fa-upload"></i> Unggah </a>
                  </div>
                  <div class="col-sm-4">
                    <a onClick="return confirm('Ini akan menghapus semua suara masuk. Yakin?')" href="reset-hasil.php" class="btn btn-danger"><i class="fas fa-undo"></i>Reset Suara</a>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- modal area -->
      <div class="modal fade" id="unggah-hasil">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Unggah Hasil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="dekripsi.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="pass" type="password" class="form-control"  placeholder="Masukan password untuk dekripsi" autofocus required>
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Unggah hasil terenkripsi untuk membukanya</label>
                  </div>
                </div>
            </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i>Unggah</button>
                  </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /modal area -->

      <div class="modal fade" id="unduh-hasil">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Unduh Hasil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="enkripsi.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="pass" type="password" class="form-control"  placeholder="Masukan password untuk enkripsi" autofocus required>
                </div>
            </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-download"></i>Unduh</button>
                  </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /modal area -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">E-voting team</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>v</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(document).ready(function() {
      // getData();
        // selesai();
    });
    
    function selesai() {
      setTimeout(function() {
        update();
        selesai();
      }, 200);
    };
    
    function update() {
      $.getJSON("tampil.php", function(data) {
            pemilih.innerHTML = data.pemilih;
            calon.innerHTML = data.calon;
            pilihan.innerHTML = data.pilihan;
            sisa.innerHTML = data.sisa;
            
      });
    };
    function getData() {
      $.getJSON("data-rekap.php", function(data) {
        a = 0;
        barConfig.data.datasets.splice(0, 3);
        
        $.each(data, function() {
          pieConfig.data.labels.push(this['nama']);
          pieConfig.data.datasets.forEach((dataset) => {
              dataset.data.push(this['suara']);
          });
          
          var bgColor=["#f56954","#00a65a","#00a6FF"];
          var newDataset = {
              label: data[a].nama,
              data: data[a].suara,
              backgroundColor: bgColor[a]
          };
          a++;
          barConfig.data.datasets.push(newDataset);
        });
        window.myPie.update();
        window.myBar.update();
      });
        
      };
    
    //-------------
    //- PIE CHART -
    //-------------
    window.onload = function() {
      var pieChart = document.getElementById('pieChart').getContext('2d');
      var barChart = document.getElementById('barChart').getContext('2d');
      
      window.myPie = new Chart(pieChart, pieConfig);
      window.myBar = new Chart(barChart, barConfig);
      getData();    
    };
    var pieConfig     = {
      type: 'pie',
      data: {
				datasets: [{
					data: [],
          backgroundColor : ['#f56954', '#00a65a','#00a6FF'],
				}],
				labels: [],
      },
      options :{
        maintainAspectRatio : false,
        responsive : true,
      }
    };   
    //-------------
    //- BAR CHART -
    //-------------
    var barConfig = {
      type: 'bar',
      options:{ 
        responsive: true,
        scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              },
      },
      data: {
        labels: ['Hasil Perhitungan Suara'],
        datasets: [
          {
            label: [],
            data: [],
            backgroundColor : ['#f56954']
          }
        ]
      }
    };
    
   
</script>
</body>
</html>
