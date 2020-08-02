<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola User</h1>
                </div><!-- /.col -->
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>/.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="header">
                <?= $this->session->flashdata('msg') ?>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>
                    <a class="btn bg-green float-right" href="<?= base_url() ?>admin_sistem/tambahuser" class="btn bg-green">Tambah Data</a>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="daftaruser" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Admin</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Form -->
<div id="modal-form2" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-style: none none solid none;">
                <h3 class=" m-t-none m-b">Edit Data</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_sistem/updateuser', ['class' => 'form-horizontal']) ?>
                        <!-- <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div> -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namaadmin" id="namaadmin" placeholder="Nama Admin">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="NIP" id="NIP" placeholder="NIP">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-badge"></span>
                                </div>
                            </div>
                            <select class="form-control" name="role" id="role">
                            </select>
                        </div>

                        <div class="input-group mb-3" id="fakultas_select">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university"></span>
                                </div>
                            </div>
                            <select name="fakultas" id="fakultas" class="form-control show-tick">
                                <!-- <option selected disabled>Pilih Fakultas</option>
                                <?php foreach ($fakultas as $value) { ?>
                                    <option value="<?= $value->Fakultas ?>"><?= $value->Fakultas ?></option>
                                <?php } ?> -->
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm New Password">
                        </div>




                        <div class="col-4 mt-2 float-right">
                            <input type="hidden" name="detector" id="id_modal">
                            <div class="form-group">
                                <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                                <input type="submit" name="updatedata" class="btn btn-sm btn-success float-right">
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>


                <?= form_close() ?>
            </div>
        </div>
    </div>

</div>