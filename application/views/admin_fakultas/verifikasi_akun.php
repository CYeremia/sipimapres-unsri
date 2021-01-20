<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Verifikasi Akun Mahasiswa</h1>
                </div><!-- /.col -->
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
                    <h3 class="card-title">Daftar Registrasi Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="daftarregistrasimahasiswa" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>IPK</th>
                                    <th>Status</th>
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
                <h3 class=" m-t-none m-b">Detail Data Mahasiswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_fakultas/verifikasiData', ['class' => 'form-horizontal']) ?>
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
                                    <span class="fas fa-user fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namamahasiswa" id="namamahasiswa" placeholder="Nama Mahasiswa" readonly='true'>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="NIM" id="NIM" placeholder="NIM" readonly='true'>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" readonly='true'>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="tlp" id="tlp" placeholder="Telephone | 0812xxxxxxxx" required readonly='true'>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="prodi" id="prodi" placeholder="Program Studi" required readonly='true'>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-star fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="IPK" id="IPK" placeholder="IPK | 4.00" required readonly='true'>
                        </div>

                        <div class="col-4 mt-2 float-right">
                            <!-- <input type="hidden" name="detector" id="id_modal"> -->
                            <div class="form-group">
                                <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                                <input type="submit" name="verifikasi" value="Verifikasi" class="btn btn-sm btn-success float-right"></input>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

    </div>
</div>