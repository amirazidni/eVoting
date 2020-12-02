<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="Dasbor" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/ex-logo1.png" alt="eVoting Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Voting</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="dashboard" class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="verify" class="nav-link <?= $this->uri->segment(2) == 'verify' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Verifikasi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Rekapitulasi</p>
                    </a>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                        <li class="nav-item">
                            <a href="datarekap" class="nav-link <?= $this->uri->segment(2) == 'user' ? 'active' : ''; ?>">
                                <p style="padding-left: 32px;">Rekap #1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="datarekap" class="nav-link <?= $this->uri->segment(2) == 'token' ? 'active' : ''; ?>">
                                <p style="padding-left: 32px;">Rekap #2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="datarekap" class="nav-link <?= $this->uri->segment(2) == 'network' ? 'active' : ''; ?>">
                                <p style="padding-left: 32px;">Rekap #3</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>