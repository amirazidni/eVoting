<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pemilihan Online</title>

  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    th,
    td {
      white-space: nowrap;
    }
  </style>
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
          <h2 class="text-dark">Data Pemilih</h2>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <div class="info">
            <a href="" data-toggle="modal" data-target="#konfirmkeluar" class="d-block"> <i class="fa fa-power-off"></i>
              Log out</a>
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
      <a href="dashboard" class="brand-link">
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
              <a href="dashboard" class="nav-link">
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


      <?php if ($this->session->flashdata('success_msg')) {

      ?>
        <div class="alert alert-success">
          <center>
            <?php echo $this->session->flashdata('success_msg'); ?>
          </center>
        </div>
      <?php
      } ?>
      <?php if ($this->session->flashdata('error_msg')) {

      ?>
        <div class="alert alert-danger">
          <center>
            <?php echo $this->session->flashdata('error_msg'); ?>
          </center>
        </div>
      <?php
      } ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="row mb-2">
                <div class="col-12 d-flex">
                  <button type="button" class="ml-auto btn btn-success" data-toggle="modal" id="import_data"><i class="fa fa-envelope"></i> Import Data Excel/CSV</button>
                  <button type="button" class="ml-2 btn btn-primary" data-toggle="modal" id="insert_data"><i class="fa fa-plus"></i> Tambah Pemilih</button>
                </div>
              </div>
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="example1" class="w-100 table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Nama Pemilih</th>
                        <th>Kelas</th>
                        <th>Aktivasi</th>
                        <th>Suara</th>
                      </tr>
                    </thead>
                    <tbody>
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
      </section>
      <!-- /.content -->
    </div>


    <!-- modal tambah -->
    <div class="modal fade" id="insert_data_modal">
      <div class="modal-dialog">
        <!-- Insert Data -->
        <div class="modal-content" id="insert_data_form"></div>
        <!-- Import Data -->
        <div class="modal-content" id="insert_data_import"></div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /modal tambah -->


    <!-- modal Ubah -->
    <div class="modal fade" id="editdata">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pemilih</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="edit_form" action="" method="post">
              <div class="row form-group">
                <div class="col col-md-3"><label for="edit_nim" class=" form-control-label">NIM</label></div>
                <div class="col-12 col-md-9">
                  <input type="text" id="edit_nim" name="nim" placeholder="NIM" class="form-control" required readonly value="">
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="edit_nama" class=" form-control-label">Nama Pemilih</label></div>
                <div class="col-12 col-md-9">
                  <input type="text" id="edit_nama" name="nama" placeholder="Nama" class="form-control" required value="">
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="edit_kelas" class=" form-control-label">kelas</label></div>
                <div class="col-12 col-md-9">
                  <input type="text" id="edit_kelas" name="kelas" placeholder="kelas" class="form-control" required value="">
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="edit_password" class=" form-control-label">password</label></div>
                <div class="col-12 col-md-9">
                  <input type="password" id="edit_password" name="password" placeholder="password" class="form-control" required value="">
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
          </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
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
            <form action="<?= site_url('welcome_admin/logout'); ?>">
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
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const t = $("#example1").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "order": [
          [0, "asc"]
        ],
        "processing": true,
        "serverSide": true,
        ajax: {
          url: `<?= base_url('pengawas2/show_all'); ?>`,
          type: "post",
        },
        columns: [{
            data: 'id'
          },
          {
            data: "nim"
          },
          {
            data: "nama"
          },
          {
            data: "kelas"
          },
          {
            data: "aktivasi",
            render: function(data, type, row) {
              if (data == 0) {
                return `<button type="button" class="btn btn-sm btn-danger">Belum Diaktivasi</button>`;
              } else {
                return `<button type="button" class="btn btn-sm btn-success">Telah Diaktivasi</button>`;
              }
            }
          },
          {
            data: "suara",
            render: function(data, type, row) {
              if (data == 0) {
                return `<button type="button" class="btn btn-sm btn-danger">Belum Memilih</button>`;
              } else {
                return `<button type="button" class="btn btn-sm btn-success">Telah Memilih</button>`;
              }
            }
          },
        ]
      });
      t.on('order.dt search.dt', function() {
        t.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw(); // digunakan untuk menambah index nomor column

      const insertData = document.querySelector('#insert_data');
      const importData = document.querySelector('#import_data');
      const insertDataForm = document.querySelector('#insert_data_form');
      const insertDataImport = document.querySelector('#insert_data_import');
      const insertDataModal = $('#insert_data_modal');

      insertData.addEventListener('click', function() {
        insertDataForm.innerHTML = `
          <div class="modal-header">
            <h4 class="modal-title">Tambah Pemilih</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h2>Fitur ini tidak tersedia pada pengawas & operator</h2>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        `;
        insertDataModal.modal();
      });

      importData.addEventListener('click', function() {
        insertDataImport.innerHTML = `
          <div class="modal-header">
            <h4 class="modal-title">Import Data Pemilih</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h2>Fitur ini tidak tersedia pada pengawas & operator</h2>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_upload">Upload Sekarang</button>
          </div>
        `;
        insertDataModal.modal();
      });

      insertDataModal.on('hidden.bs.modal', function() {
        insertDataImport.innerHTML = null;
        insertDataForm.innerHTML = null;
      });
    });
  </script>
</body>

</html>