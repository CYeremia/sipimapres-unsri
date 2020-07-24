<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Prestasi Mahasiswa</h1>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <table id="inputPrestasi" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
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
            <div class="modal-header">
                <h3 class="m-t-none m-b">Detail Mahasiswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_fakultas/seleksipage', ['class' => 'form-horizontal']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="namamahasiswa" id="namamahasiswa" placeholder="Nama" required>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-id-card-alt"></i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="Nimmahasiswa" id="Nimmahasiswa" placeholder="Nim" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="material-icons">book</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="prodi" id="prodi" placeholder="Program Studi" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-university"></i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="fakultas" id="fakultas" placeholder="Fakultas" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="material-icons">book</i>
                                </div>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="IPK" id="IPK" placeholder="IPK" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone-square-alt"></span>
                                </div>
                            </div>
                            <div class="form-line">
                                <input type="text" class="form-control" name="Notlp" id="Notlp" placeholder="No. Telephone" required>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe-americas"></span>
                                </div>
                            </div>
                            <select class="form-control" name="prestasi" id="prestasi" required>
                                <option selected disabled>Pilih Prestasi</option>
                                <option>Prestasi Kompetisi</option>
                                <option>Prestasi Non Kompetisi</option>
                            </select>
                        </div>

                        <input type="hidden" name="detector" id="id_modal">
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="submit" name="datamahasiswa" value="Ubah" class="btn btn-sm btn-success pull-right">
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>