<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVoting</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/fa-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pace.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        th,
        td {
            white-space: nowrap;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Loading Modal -->
    <div class="modal" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Loading</h4>
                </div>
                <div class="text-center my-3">
                    <div style="width: 5rem; height: 5rem;" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Info</h4>
                </div>
                <div class="my-3">
                    <p class="mx-3" id="infoContentModal"></p>
                    <div class="mx-3" id="infoDetailModal"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Note -->
    <div class="modal fade" id="photoDetailModal" tabindex="-1" role="dialog" aria-labelledby="photo-detail-modal" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img style="width: 100%;" id="photoDetail" src="" alt="Image Voter">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Logout -->
    <div class="modal fade" id="logoutConfirm" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Apakah anda yakin ingin keluar?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <form action="<?= base_url('auth/logoutAction'); ?>">
                        <input type="submit" class="btn btn-primary" value="Ya">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <?= $this->include('Layout/Navbar'); ?>
        <?= $this->include('Layout/Sidebar'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content'); ?>
                </div>
            </section>
        </div>
    </div>

</body>

<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap4.js') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>

<?= $this->renderSection('script'); ?>

</html>