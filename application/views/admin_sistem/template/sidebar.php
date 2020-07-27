<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link d-flex">
        <img src="<?= base_url('assets') ?>/dist/img/logo.png" alt="" class="brand-image img-circle" style="opacity: .8">
        <img src="<?= base_url('assets') ?>/dist/img/logo-full.png" alt="" class="brand-image">
        <!-- <span class="brand-text font-weight-light">Si-Pimapres</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="nav-item">
                <img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                <!-- <a href="#" class="d-block"><?= $user['Nama'] ?> -->
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $userdata->Nama ?></a>
                <a href="#" class="d-block">(<?= $userdata->IDPengenal ?>)</a>
                <!-- <a href="#" class="d-block"><?= $user['Nama'] ?></a>
                <a href="#" class="d-block">(<?= $user['IDPengenal'] ?>)</a> -->
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- <li class="nav-item"> -->
                <li class="nav-item">
                    <a href="<?= site_url('admin_sistem') ?>" class="nav-link <?php if ($active == 1) {
                                                                                    echo "active";
                                                                                } ?> ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('admin_sistem/Peringkat_Mahasiswa') ?>" class="nav-link <?php if ($active == 2) {
                                                                                                        echo "active";
                                                                                                    } ?> ">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Peringkat Mahasiswa
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link <?php if ($active == 3 || $active == 4) {
                                                    echo "active";
                                                } ?> ">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>
                            Analisis Peringkat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('') ?>" class="nav-link <?php if ($active == 3) {
                                                                                echo "active";
                                                                            } ?> ">
                                <i class="nav-icon fas fa-trophy"></i>
                                <p>Per Fakultas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('') ?>" class="nav-link <?php if ($active == 4) {
                                                                                echo "active";
                                                                            } ?> ">
                                <i class="nav-icon fas fa-award"></i>
                                <p>Per Bidang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('') ?>" class="nav-link <?php if ($active == 5) {
                                                                        echo "active";
                                                                    } ?> ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Kelola User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('') ?>" class="nav-link <?php if ($active == 6) {
                                                                        echo "active";
                                                                    } ?> ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Kelola Bidang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
    </div>
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->