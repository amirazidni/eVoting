<?php $this->load->view('pages/operator/Header.php'); ?>

<div class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view('pages/operator/Navbar'); ?>

        <?php $this->load->view('pages/operator/Sidebar'); ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="tbl_operator" class="w-100 table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ip Address</th>
                                                <th>NIM</th>
                                                <th>Nama Pemilih</th>
                                                <th>Kelas</th>
                                                <th>ID Suara</th>
                                                <th>Activasi</th>
                                                <th>No. Telp</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
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
                        <form action="<?= site_url('welcome_admin/logout'); ?>">
                            <input type="submit" class="btn btn-primary" value="Ya">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <!-- <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.0.5
                </div> -->
            <strong>Copyright &copy; 2020</strong> All rights
            reserved.
        </footer>
    </div>
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
</div>

<?php $this->load->view('pages/operator/Footer'); ?>