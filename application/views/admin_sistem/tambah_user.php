<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah User Admin</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card col-md-5 col-12">
                <div class="header">
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <div class="card-header">
                    <h1 class="card-title">Tambah User</h1>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_sistem/tambahdatauser', ['class' => 'form-horizontal']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namaadmin" id="namaadmin" placeholder="Nama Admin" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="NIP" id="NIP" placeholder="NIP" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-badge fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="role" id="role" required>
                                <option selected disabled>Pilih Role</option>
                                <option value="Administrator Sistem">Administrator Sistem</option>
                                <option value="Administrasi Fakultas">Administrasi Fakultas</option>
                            </select>
                        </div>

                        <div class="input-group mb-3" id="fakultas_select">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <select name="fakultas" id="fakultas" class="form-control show-tick">
                                <option selected disabled>Pilih Fakultas</option>
                                <?php foreach ($fakultas as $value) { ?>
                                    <option value="<?= $value->Fakultas ?>"><?= $value->Fakultas ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock fa-fw"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock fa-fw"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" required>
                        </div>

                        <div class="col-4 mt-2 float-right">
                            <div class="form-group">
                                <input type="submit" name="tambahuser" class="btn btn-sm btn-success float-right">
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>