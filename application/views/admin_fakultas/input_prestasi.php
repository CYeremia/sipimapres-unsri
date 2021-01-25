<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Prestasi Mahasiswa</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="header">
                    <?= $this->session->flashdata('msg') ?>
                    <?php
                    if (isset($error)) {
                        echo "ERROR UPLOAD : <br/>";
                        print_r($error);
                        echo "<hr/>";
                    }
                    ?>
                </div>
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>

                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
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
                <h3 class=" m-t-none m-b">Detail Mahasiswa</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_fakultas/TambahPrestasi', ['class' => 'form-horizontal']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namamahasiswa" id="namamahasiswa" placeholder="Nama" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Nimmahasiswa" id="Nimmahasiswa" placeholder="Nim" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-graduation-cap fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="prodi" id="prodi" placeholder="Program Studi" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="fakultas" id="fakultas" placeholder="Fakultas" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-star fa-fw fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="IPK" id="IPK" placeholder="IPK" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone-alt fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Notlp" id="Notlp" placeholder="No. Telephone" readonly="true">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-globe-americas fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="prestasi" id="prestasi" required>
                                <option selected disabled>Pilih Prestasi</option>
                                <option>Kompetisi</option>
                                <option>Non Kompetisi</option>
                            </select>
                        </div>

                        <div class="col-4 mt-2 float-right">
                            <input type="hidden" name="detector" id="id_modal">
                            <div class="form-group">
                                <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                                <input type="submit" name="datamahasiswa" value="Tambah Prestasi" class="btn btn-sm btn-success float-right">
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