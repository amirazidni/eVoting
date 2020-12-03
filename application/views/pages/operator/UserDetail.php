<?php $this->load->view('pages/operator/Header'); ?>

<div class="wrapper">

    <?php $this->load->view('pages/operator/Navbar'); ?>

    <?php $this->load->view('pages/operator/Sidebar'); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2">
                    <h1>User ID <?= $userId; ?></h1>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tbl-user-detail" class="w-100 table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Pemilih</th>
                                    <th>Kelas</th>
                                    <th>No. Telp</th>
                                    <th>KPU</th>
                                    <th>Note</th>
                                    <th>Vote</th>
                                    <th>Photo</th>
                                    <th>Rekap</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['nim']; ?></td>
                                        <td><?= $item['nama']; ?></td>
                                        <td><?= $item['kelas']; ?></td>
                                        <td><?= $item['phone']; ?></td>
                                        <td><?= $item['comitteeName'] ?? '-'; ?></td>
                                        <td>
                                            <?php

                                            $data = $item['note'];
                                            if ($data) {
                                                if (strlen($data) > 24) {
                                                    $note = substr($data, 0, 20) . ' ...';
                                                } else {
                                                    $note = $data;
                                                }
                                            } else {
                                                $note = '-';
                                            }

                                            ?>
                                            <p class="pointer" onclick="onDetailNote(`<?= $data; ?>`)"><?= $note; ?></p>
                                            <?php

                                            ?>
                                        </td>
                                        <td><?= $item['candidateNumber']; ?></td>
                                        <td>
                                            <?php

                                            if ($item['photoPath']) {
                                            ?>
                                                <button class="btn btn-info btn-sm" onclick="onPhotoDetail('<?= base_url('assets/voter/' . $item['photoPath']); ?>')">Lihat Foto</button>
                                            <?php
                                            } else {
                                                echo '<p><b> - </b></p>';
                                            }

                                            ?>
                                        </td>
                                        <td><?= $item['recap'] == 'CLEAN' ? 'Bersih' : ($item['recap'] == 'DIRTY' ? 'Kotor' : ' - '); ?></td>
                                        <td>
                                            <form class="d-inline" action="<?= base_url('operator/setRecap'); ?>" method="post">
                                                <input type="text" name="deviceToken" value="<?= $item['deviceToken']; ?>" hidden>
                                                <input type="text" name="recap" value="CLEAN" hidden>
                                                <input type="text" name="userId" value="<?= $userId; ?>" hidden>
                                                <button class="btn btn-success btn-sm" <?= $item['recap'] == 'CLEAN' ? 'disabled' : ''; ?>>Bersih</button>
                                            </form>
                                            <form class="d-inline" action="<?= base_url('operator/setRecap'); ?>" method="post">
                                                <input type="text" name="deviceToken" value="<?= $item['deviceToken']; ?>" hidden>
                                                <input type="text" name="recap" value="DIRTY" hidden>
                                                <input type="text" name="userId" value="<?= $userId; ?>" hidden>
                                                <button class="btn btn-danger btn-sm" <?= $item['recap'] == 'DIRTY' ? 'disabled' : ''; ?>>Kotor</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
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

    <!-- Modal Detail Note -->
    <div class="modal fade" id="photo-detail-modal" tabindex="-1" role="dialog" aria-labelledby="photo-detail-modal" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img style="width: 100%;" id="photo-detail" src="" alt="Image Voter">
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
        $("#tbl-user-detail").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "processing": true,
        })
    })

    let photoDetail = $('#photo-detail')
    let photoModal = $('#photo-detail-modal')

    function onPhotoDetail(photoPath) {
        photoDetail.attr('src', photoPath)
        photoModal.modal('show')
    }

    function onDetailNote(note) {
        $('#note-detail').text(note)
        $('#note-detail-modal').modal('show')
    }
</script>

<?php $this->load->view('pages/operator/Footer'); ?>