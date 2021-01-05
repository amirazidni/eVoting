<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="Dasbor" class="brand-link">
        <img src="<?= base_url('assets/images/ex-logo1.png') ?>" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Voting</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $linkName == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('operator') ?>" class="nav-link <?= $linkName == 'operator' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Operator</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('VoteType') ?>" class="nav-link <?= $linkName == 'votetype' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Data Tipe Surat Suara</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('voter') ?>" class="nav-link <?= $linkName == 'voter' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Pemilih</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('candidate') ?>" class="nav-link <?= $linkName == 'candidate' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Data Calon</p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="<?= base_url('export') ?>" class="nav-link <?= $linkName == 'export' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Export PDF</p>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a href="<?= base_url('verify') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Verifikasi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('recap') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Rekap Data</p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="#logoutConfirm" data-toggle="modal" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>