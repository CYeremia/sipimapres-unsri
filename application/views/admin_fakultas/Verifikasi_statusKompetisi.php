<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Verifikasi Data Prestasi Kompetisi</h1>
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Data Prestasi</h3>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <?= form_open_multipart('admin_fakultas/Verifikasi_statuskompetisi?id='$IDM->IDPrestasi, ['class' => 'form-horizontal']) ?>
                        <table id="verifikasi" style="width:100%" class="table table-bordered table-hover dataTable">
                            <thead></thead>
                            <tbody>
                                <!-- <form role="form"> -->
                                <tr>
                                    <td style="width: 20%">Nama Mahasiswa</td>
                                    <td>


                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-dice-d20"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama Mahasiswa" value="<?php echo ($NamaM->Nama) ?>" required>
                                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">NIM</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-dice-d20"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="NIM" id="NIM" placeholder="Nim Mahasiswa" value="<?php echo ($IDM->PeraihPrestasi) ?>" required>
                                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style=" width: 20%">Judul Perlombaan
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-dice-d20"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="JudulLomba" id="JudulLomba" placeholder="Judul Perlombaan" value="<?php echo ($IDM->Perlombaan) ?>" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Bidang</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-code-branch"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="bidang" id="bidang" placeholder="Bidang" value="<?php echo ($IDM->Bidang) ?>" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Penyelenggara</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-university"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="Penyelenggara" id="Penyelenggara" placeholder="Penyelenggara" value="<?php echo ($IDM->Penyelenggara) ?>" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Kategori</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-users"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo ($IDM->Kategori) ?>" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Pencapaian</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-trophy"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="pencapaian" id="pencapaian" placeholder="Pencapaian" value="<?php echo ($IDM->Pencapaian) ?>" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Bukti Prestasi</td>
                                    <td><img onclick="BuktiPrestasi(<?= $IDM->BuktiPrestasi ?>)" id="myImg" style="width:200px" src="<?= base_url('uploads') ?>/<?= $IDM->BuktiPrestasi ?>"></td>
                                </tr>
                                <!-- onclick="BuktiPrestasi(<?= $IDM->BuktiPrestasi ?>)" -->

                                <tr>
                                    <td style="width: 20%">Tahun</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calendar-alt"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo ($IDM->Tahun) ?>" required>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Tingkat</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-globe-americas"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="tingkat" id="tingkat" placeholder="Tingkat" value="<?php echo ($IDM->Tingkat) ?>" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Link Berita</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-link"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="berita" id="berita" placeholder="Link Berita" value="<?php echo ($IDM->LinkBerita) ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Status</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-globe-americas"></span>
                                                </div>
                                            </div>
                                            <select class="form-control" name="status" id="status" required>
                                                <option selected disabled><?php echo ($IDM->Status) ?></option>
                                                <option>Diterima</option>
                                                <option>Ditolak</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" name="submit" class="btn btn-primary float-right"></input>
                        <?= form_close() ?>
                    </div>
                </div>
                <!-- /.card-header -->



            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- The Modal -->
<div class="modal" id="Modal-Img">
    <div class="modal-header">
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <center><img style="margin-top: 5%; width: auto; height: auto;" class="modal-content" id="img"></center>
    </div>
</div>