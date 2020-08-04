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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.js"></script>

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
      
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="#" class="nav-link active">
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
            <a href="rekapitulasi.php" class="nav-link">
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
                  <h3><div id="pemilih"></div></h3>
                <p>Jumlah Pemilih</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-person-add"></i>
              </div>
              
                <a href="data-pemilih.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><div id="calon"></div></h3>
                <p>Jumlah Calon</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="data-calon.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><div id="suara_masuk"></div></h3>

                <p>Suara Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-checkbox"></i>
              </div>
              <a href="rekapitulasi.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><div id="sisa"></div></h3>

                <p>Suara Belum Digunakan</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-walk"></i>
              </div>
              <a href="data-pemilih.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- </div> ./load latest -->
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
              <h4></h4>
            </div>
            <!-- /.PIE card -->
            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
          <!-- <div class="card card-primary">
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
              <canvas id="chartContainer" style="height: 300px; width: 100%;"></canvas>
              </div>
              /.card-body 
            </div> -->
          

            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
        
    <!-- /Main content -->    
        
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
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>




</body>
</html>
<!-- CUSTOM DATA VIEW REALTIME -->
<script type="text/javascript">
    var pemilih = document.getElementById('pemilih');
    var calon = document.getElementById('calon');
    var pilihan = document.getElementById('suara_masuk');
    var sisa = document.getElementById('sisa');
    $(document).ready(function() {
        selesai();
        updatePie();
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
    function updatePie() {
      setTimeout(function() {
        pieConfig.data.datasets[0].data[0] = pilihan.innerHTML; //suara masuk 
        pieConfig.data.datasets[0].data[1] = sisa.innerHTML; //suara sisa       
        window.myPie.update();
        updatePie();
      }, 2000);
    }
    

    /* ChartJS */
    var pieConfig        = {
      type: 'pie',
      data: {
				datasets: [{
					data: [ 0, 0 ],
					backgroundColor : ['#00a65a', '#ffc107'],
				}],
				labels: [ 'Suara Masuk', 'Suara Belum Digunakan'],
      },
      options :{
        maintainAspectRatio : false,
        responsive : true,
      }
    };
    window.onload = function() {
			var ctx = document.getElementById('pieChart').getContext('2d');
			window.myPie = new Chart(ctx, pieConfig);
		};  
</script>