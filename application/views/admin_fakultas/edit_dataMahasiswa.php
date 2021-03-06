<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Data Mahasiswa</h1>
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
                    <h1 class="card-title">Data Mahasiswa</h1>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_fakultas/updateData', ['class' => 'form-horizontal']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namaMahasiswa" id="namaMahasiswa" placeholder="Nama Mahasiswa" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="NIM" id="NIM" placeholder="NIM Mahasiswa" required>
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
                                    <span class="fas fa-phone-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="tlp" id="tlp" placeholder="Telephone | 0812xxxxxxxx" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <select name="prodi" id="prodi" class="form-control show-tick">
                                <option selected disabled>Pilih Program Studi</option>
                                <!-- <?php foreach ($fakultas as $value) { ?>
                                    <option value="<?= $value->Fakultas ?>"><?= $value->Fakultas ?></option>
                                <?php } ?> -->
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-star fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="IPK" id="IPK" placeholder="IPK | 4.00" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock fa-fw"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock fa-fw"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm New Password">
                        </div>

                        <div class="col-4 mt-2 float-right">
                            <div class="form-group">
                                <input type="hidden" name="IDL" id="IDL">
                                <input type="submit" name="updateData" class="btn btn-sm btn-success float-right">
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