<?php $this->load->view('pages/operator/Header'); ?>

<div class="wrapper">

    <?php $this->load->view('pages/operator/Navbar'); ?>

    <?php $this->load->view('pages/operator/Sidebar'); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="pt-4">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="tbl-user" class="w-100 table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama Pemilih</th>
                                        <th>Kelas</th>
                                        <th>Jumlah Suara</th>
                                        <th>No. Telp</th>
                                        <th>Rekap</th>
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
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

<script type="text/javascript">
    $(document).ready(() => {
        $("#tbl-user").DataTable({
            'initComplete': () => {
                $('#tbl-verify_filter input').val('<?= $lastSearch; ?>')
            },
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
            "ajax": {
                url: `<?= base_url('operator/getsRecapUser'); ?>`,
                type: "POST",
            },
            "columns": [{
                data: "nim"
            }, {
                data: "nama"
            }, {
                data: "kelas"
            }, {
                data: "count"
            }, {
                data: "phones"
            }, {
                data: "recaps",
            }, {
                data: "action",
                render: (data, type, row) => {
                    let userId = row['userId']

                    return `<button class="btn btn-sm btn-primary ml-2" onclick="location.href='<?= base_url('operator/user/'); ?>${userId}'">Detail</button>`;
                }
            }]
        }).search('<?= $lastSearch; ?>').draw()
    })
</script>

<?php $this->load->view('pages/operator/Footer'); ?>