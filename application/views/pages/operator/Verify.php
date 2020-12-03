<?php $this->load->view('pages/operator/Header'); ?>

<div class="wrapper">

    <?php $this->load->view('pages/operator/Navbar'); ?>

    <?php $this->load->view('pages/operator/Sidebar'); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tbl-verify" class="w-100 table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama Pemilih</th>
                                            <th>Kelas</th>
                                            <th>No. Telp</th>
                                            <th>KPU</th>
                                            <th>Note</th>
                                            <th>Terakhir Update</th>
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

    <!-- Modal Note -->
    <div class="modal fade" id="note-modal" tabindex="-1" role="dialog" aria-labelledby="noteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('operator/note'); ?>" method="post">
                    <div class="modal-body">
                        <input type="text" id="device-token" name="deviceToken" hidden>
                        <input type="text" id="last-search" name="lastSearch" hidden>
                        <textarea class="form-control" name="note" id="note-textarea" rows="6"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Note -->
    <div class="modal fade" id="note-detail-modal" tabindex="-1" role="dialog" aria-labelledby="note-detail-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <pre id="note-detail"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
        $("#tbl-verify").DataTable({
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
                url: `<?= base_url('operator/getsVerify'); ?>`,
                type: "POST",
            },
            "columns": [{
                data: "nim"
            }, {
                data: "nama"
            }, {
                data: "kelas"
            }, {
                data: "phone"
            }, {
                data: "comitteeCode",
                render: (data, type, row) => {
                    if (data) {
                        return '<i class="nav-icon fas fa-check"></i>'
                    }

                    return '<i class="nav-icon fas fa-minus"></i>'
                }
            }, {
                data: "note",
                render: (data, type) => {
                    let note
                    if (data) {
                        if (data.length > 36) {
                            note = data.substring(0, 32) + ' ...'
                        } else {
                            note = data
                        }
                    } else {
                        note = '-'
                    }

                    return `<p class="pointer" onclick="onDetailNote(\`${data}\`)">${note}</p>`
                }
            }, {
                data: 'updatedAt',
            }, {
                data: "action",
                render: (data, type, row) => {
                    let note = row['note']
                    let deviceToken = row['deviceToken']
                    let isVerify = row['isVerify'] == '1'
                    let btnNote = `<button class="btn btn-sm btn-success" onclick="openNoteModal('${deviceToken}', \`${note ?? ''}\`)">${ note ? 'Update' : 'Add'} Note</button>`
                    let btnVerify = `
                    <form class="d-inline" action="<?= base_url('operator/setVerify'); ?>" method="post">
                        <input type="text" name="deviceToken" value="${deviceToken}" hidden>
                        <input id=${deviceToken + '-search'} type="text" name="lastSearch" hidden>
                        <button class="btn btn-sm btn-primary ml-2" ${isVerify ? 'disabled' : ''} onclick="onSetVerify('${deviceToken + '-search'}')">${isVerify ? 'Verified' : 'Verify'}</button>
                    </form>
                    `

                    return btnNote + btnVerify
                }
            }, ]
        }).search('<?= $lastSearch; ?>').draw()
    })

    function onDetailNote(note) {
        $('#note-detail').text(note)
        $('#note-detail-modal').modal('show')
    }

    function onSetVerify(id) {
        $(`#${id}`).val($('#tbl-verify_filter input').val())
    }

    function openNoteModal(deviceToken, note) {
        $('#note-textarea').val(note)
        $('#last-search').val($('#tbl-verify_filter input').val())
        $('#device-token').val(deviceToken)
        $('#note-modal').modal('show')
    }
</script>

<?php $this->load->view('pages/operator/Footer'); ?>