<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pemilihan Online</title>

  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

<?php

$login=$this->session->userdata('status');
if($login=='loginadmin'){
    
}else if($login=='loginsiswa'){
    redirect(base_url('?pesan=salah'));
}else if($login=='loginpengawas'){
    redirect(base_url('?pesan=salah'));
}else{
    redirect(base_url('?pesan=belumlogin'));
}

?>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <h2 class="text-dark">Data Pemilih</h2>
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
      <img src="<?=base_url()?>assets/dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="Dasbor" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
            </li>
          
          <li class="nav-item">
            <a href="Datapem" class="nav-link active">
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
                Rekapitulasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Datapeng" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" data-toggle="modal" data-target="#konfirmkeluar" class="nav-link">
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


        <?php if($this->session->flashdata('success_msg')){

            ?>
            <div class="alert alert-success"><center>
                <?php echo $this->session->flashdata('success_msg'); ?>                
            </center></div>
            <?php
        } ?>
        <?php if($this->session->flashdata('error_msg')){

            ?>
            <div class="alert alert-danger"><center>
                <?php echo $this->session->flashdata('error_msg'); ?>                
            </center></div>
            <?php
        } ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-6"></div>
              <div class="col-4">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Import Data Pemilih</label>
                  </div>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-info">Upload</button>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <h3><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah Pemilih</button></h3>
              </div>
            </div>
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                        <th>NIM</th>
                        <th>Nama Pemilih</th>
                        <th>Kelas</th>
                        <th>Aktivasi</th>
                        <th>Suara</th>
                        <th>Aksi</th>
                        <!-- <th width="150"><button class="btn btn-danger" data-toggle="modal" data-target="#truncate" >Kosongkan</button></th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php $no=1;
                        foreach($data->result_array() as $i):
                              $id=$i['id'];
                              $nim=$i['nim']; 
                              $nama=$i['nama']; 
                              $kelas=$i['kelas']; 
                              $suara=$i['suara'];
                              $aktivasi=$i['aktivasi'];        
                  ?>
                  <tr>
                      <td><?= "$no"?></td>
                        <td><?= $nim;?> </td>
                        <td><?= $nama;?> </td>
                        <td><?= $kelas;?> </td>
                      <td><?php
                            if ($aktivasi=='0') {
                                ?>
                                    <button type="button" class="btn btn-danger">Belum Diaktivasi</button>
                                <?php
                            }else{
                                ?>
                                    <button type="button" class="btn btn-success">Telah Diaktivasi</button>
                                <?php
                            };
                        ?> </td>
                        <td><?php
                            if ($suara=='0') {
                                ?>
                                    <button type="button" class="btn btn-danger">Belum Memilih</button>
                                <?php
                            }else{
                                ?>
                                    <button type="button" class="btn btn-success">Telah Memilih</button>
                                <?php
                            };
                        ?> </td>
                    </td>
                    <td>


                      <a class="btn btn-success" data-toggle="modal" data-target="#editdata<?php echo $id;?>"  href=""><i class="fa fa-edit"></i></a>

                      <?php
                            if ($aktivasi=='0') {
                                ?>
                                    <a class="btn btn-warning" href="datapem/edita/<?php echo $id;?>" title="Absen" href=""><i class="fa fa-lock"></i></a>
                                <?php
                            }else{
                                ?>
                                     <a class="btn btn-primary" href="datapem/editbatal/<?php echo $id;?>" title="Batal Absen"  href=""><i class="fa fa-unlock"></i></a>
                                <?php
                            };
                        ?>
                            
                      <a class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Reset Pilihan" href="<?php echo  base_url('index.php/datapem/resetpilihan/'.$id);?>"><i class="fa fa-undo"></i></a>
                          
                      <a class="btn btn-danger" href="<?php echo  base_url('index.php/datapem/delete/'.$id);?>"><i class="fa fa-trash"></i></a>   
                        </td>
                  </tr>
                  
                  <?php $no++; endforeach;?>
                  </tbody>
                  
                </table>
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
      <!-- modal area -->
      <div class="modal fade" id="tambah-pemilih">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pemilih</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="tambahcalon.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="email">NIM:</label>
                    <input name="nim" class="form-control" id="nim" placeholder="Masukan NIM" autofocus required>
                </div>
                <div class="form-group">
                    <label for="email">Nama:</label>
                    <input name="nama" class="form-control" id="nama" placeholder="Masukan Nama" required>
                </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" >Reset</button>
                <button type="button" class="btn btn-primary">Tambah</button>
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


   <!-- modal tambah -->
      <div class="modal fade" id="tambahdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pemilih</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?= form_open_multipart('datapem/insert');?>
              <form action="datapem/insert" method="post">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="nim" class=" form-control-label">NIM</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nim" name="nim" placeholder="NIM"  class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="password" class=" form-control-label">password</label></div>
                      <div class="col-12 col-md-9">
                        <input type="password" id="password" name="password" placeholder="password" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="nama" class=" form-control-label">Nama Pemilih</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nama" name="nama" placeholder="Nama"  class="form-control" required>
                    </div>
                </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="kelas" class=" form-control-label">kelas</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="kelas" name="kelas" placeholder="kelas" class="form-control" required>
                    </div>
                </div>
                    
                </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" >Reset</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- /modal tambah -->


<!-- modal Ubah -->
 <?php
        foreach($data->result_array() as $i):
                              $id=$i['id'];
                              $nim=$i['nim']; 
                              $password=$i['password'];
                              $nama=$i['nama']; 
                              $kelas=$i['kelas']; 
                              $suara=$i['suara'];
                              ?>
      <div class="modal fade" id="editdata<?= $id;?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pemilih</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?=site_url('datapem/edit/'.$id);?>" method="post">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="nim" class=" form-control-label">NIM</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nim" name="nim" placeholder="NIM"  class="form-control" required readonly value="<?= $nim; ?>">
                    </div>
                </div>

                <!--<div class="row form-group">
                    <div class="col col-md-3"><label for="password" class=" form-control-label">password</label></div>
                      <div class="col-12 col-md-9">-->
                        <input type="hidden" id="password" name="password" placeholder="password" required readonly value="<?= $password; ?>">
                    <!--</div>
                </div>-->

                <div class="row form-group">
                    <div class="col col-md-3"><label for="nama" class=" form-control-label">Nama Pemilih</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="nama" name="nama" placeholder="Nama"  class="form-control" required value="<?= $nama; ?>">
                    </div>
                </div>

                  <div class="row form-group">
                    <div class="col col-md-3"><label for="kelas" class=" form-control-label">kelas</label></div>
                      <div class="col-12 col-md-9">
                        <input type="text" id="kelas" name="kelas" placeholder="kelas" class="form-control" required value="<?= $kelas; ?>">
                    </div>
                </div>
                    
                </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" >Reset</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
              </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <?php endforeach;?>
<!-- /modal Ubah -->


<!--Modal Keluar -->
       <div class="modal fade" id="konfirmkeluar" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
                        </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <form  action="<?=site_url('Welcome/logout'); ?>">
                        <input type="submit" class="btn btn-primary" value="Ya">
                    </form>
                    </div>
                </div>
            </div>
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
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
