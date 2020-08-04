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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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
        <h2 class="text-dark">Data Calon | Edit</h2>
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
            <a href="data-calon.php" class="nav-link active">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-10"></div>
              <div class="col-2">
                
              </div>
            </div>
            <div class="card">
            <?php
                $no = $_GET['no'];
                if(empty($no)){
                    header("location:data-calon.php");	
                }
                $query = mysqli_query($kon, "SELECT * FROM calon where id = '$no'");
                $hasil = mysqli_fetch_array($query);
                    
            function alert($alert){
                echo "<script type='text/javascript'>
                    alert('".$alert."');
                    </script>";
            }
            function redir($redir){
                echo "<script type='text/javascript'>
                    document.location='".$redir."';
                    </script>";
            }

            
                    if(!empty($_POST)){
                        extract($_POST);
                        $nomor_urut = mysqli_real_escape_string($kon, $_POST['nomor_urut']);
                        $nama_ketua = mysqli_real_escape_string($kon, $_POST['nama_ketua']);
                        $nama_wakil = mysqli_real_escape_string($kon, $_POST['nama_wakil']);
                        $visi_misi = mysqli_real_escape_string($kon, $_POST['visi_misi']);
                        $namafile	= $_FILES['dp']['name'];
                        $namafile2	= strtolower("calon-".$nama_ketua."-".$namafile);
                        $fileSize	= $_FILES['dp']['size'];  
                        $fileError	= $_FILES['dp']['error'];
                        
                        if(empty($namafile)){
                            $query = mysqli_query($kon, "UPDATE calon set nomor_urut = '$nomor_urut', nama1 = '$nama_ketua', nama2 = '$nama_wakil', visi_misi = '$visi_misi' where id = '$no'"); 
                            if($query){
                                alert('Gagal upload foto!');
                                redir('data-calon.php');	
                            }
                        }else{
                            $move = move_uploaded_file($_FILES['dp']['tmp_name'], '../../build/img/upload/'.$namafile2);
                            $query = mysqli_query($kon, "UPDATE calon set nomor_urut = '$nomor_urut', nama1 = '$nama_ketua', nama2 = '$nama_wakil', visi_misi = '$visi_misi', foto = '$namafile2' where id = '$no'"); 
                            if($query){
                                alert('Sukses');
                                redir('data-calon.php');	
                            }
                        }
                    }
                
            ?>
              <!-- /.card-header -->
              <div class="card-body">
                <form runat="server" action="" method="post" enctype="multipart/form-data">
                <h2>Edit Calon</h2>
                <table class="table table-striped">
                    <tr>
                        <th>Nomor Urut</th>
                        <th> : </th>
                        <td><input class="form-control" type="number" value="<?php echo $hasil['nomor_urut']; ?>" name="nomor_urut"/></td>
                    </tr>
                    <tr>
                        <th>Nama Ketua</th>
                        <th> : </th>
                        <td><input class="form-control" type="text" value="<?php echo $hasil['nama1']; ?>" name="nama_ketua"/></td>
                    </tr>
                    <tr>
                        <th>Nama Wakil</th>
                        <th> : </th>
                        <td><input class="form-control" type="text" value="<?php echo $hasil['nama2']; ?>" name="nama_wakil"/></td>
                    </tr>
                    <tr>
                        <th>Visi Misi</th>
                        <th> : </th>
                        <td><textarea name="visi_misi" class="form-control" type="text" style="height:100px;"><?php echo $hasil['visi_misi']; ?></textarea></td>
                    </tr>
                    </tr>
                    <tr>
                        <th rowspan="2">Foto</th>
                        <th rowspan="2"> : </th>
                        <td><img id="foto_dp" src="../../build/img/upload/<?php echo $hasil['foto']; ?>" width="30%" height="40%" ></td>
                    </tr>
                    <tr>
                        <td><input type="file" name="dp" id="foto" /></td>
                    </tr>
                    <tr>
                        <td colspan="3" ><input type="submit" class="btn btn-success" value="Submit" /></td>
                    </tr>
                </table>
                </form>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
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
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
        document.getElementById('foto_dp').src=e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
    $("#foto").change(function() {
    readURL(this);
    });

</script>
</body>
</html>
