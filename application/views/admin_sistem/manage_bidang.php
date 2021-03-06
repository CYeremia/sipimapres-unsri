<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Bidang</h1>
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
                    <h3 class="card-title">Daftar Bidang</h3>
                    <button class="btn bg-green float-right" name="tambahdata" id="tambahdata">Tambah Data</button>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="daftarbidang" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Prestasi</th>
                                    <th>Kategori Prestasi</th>
                                    <th>Nama Bidang</th>
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

<!-- Modal Form Tambah Data-->
<div id="modal-form1" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-style: none none solid none;">
                <h3 class=" m-t-none m-b">Tambah Data Bidang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_sistem/tambahbidang', ['class' => 'form-horizontal']) ?>
                        <div class="input-group mb-3" id="fakultas_select">
                            <div class="input-group-append">
                                <div class="input-group-text ">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="namabidang" id="namabidang" placeholder="Nama Bidang">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-badge fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="jalurPrestasi" id="jalurPrestasi">
                                <option selected disabled>Pilih Prestasi</option>
                                <option value="Kompetisi">Kompetisi</option>
                                <option value="Non Kompetisi">Non Kompetisi</option>
                            </select>
                        </div>

                        <div class="input-group mb-3" style="display: none;" id="Kategori_prestasi">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-medal fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="Kategori" id="Kategori">
                                <option selected disabled>Pilih Kategori Prestasi</option>
                                <option value="Organisasi">Organisasi</option>
                                <option value="Penghargaan/Pengakuan">Penghargaan/Pengakuan</option>
                            </select>
                        </div>


                        <div class="col-4 mt-2 float-right">
                            <div class="form-group">
                                <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                                <input type="submit" name="tambahdata" class="btn btn-sm btn-success float-right">
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

<!-- Modal Form Edit Data-->
<div id="modal-form2" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-style: none none solid none;">
                <h3 class=" m-t-none m-b">Edit Data Bidang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_sistem/updatebidang', ['class' => 'form-horizontal']) ?>

                        <div class="input-group mb-3" id="fakultas_select">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university fa-fw"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="nama_bidang" id="nama_bidang">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-badge fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="Jalur_Pencapaian" id="Jalur_Pencapaian">
                            </select>
                        </div>

                        <div class="input-group mb-3" style="display: none;" id="Kategori_P">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-medal fa-fw"></span>
                                </div>
                            </div>
                            <select class="form-control" name="K_Prestasi" id="K_Prestasi">
                            </select>
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