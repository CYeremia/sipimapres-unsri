<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Prestasi Kompetisi</h3>
                    </div>
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
                    <!-- /.card-header -->
                    <!-- form start -->
                    <!-- <?= form_open_multipart('admin_fakultas/Data_Kompetisi', ['class' => 'form-horizontal']) ?> -->
                    <!-- <form role="form"> -->
                    <form>
                        <div class="card-body" style="border-style: none none solid none;">
                            <h3 class="mt-1 col-md-12">Data Mahasiswa</h3>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="input-group mb-4 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="Nama" id="Nama" value="<?php echo ($_POST['namamahasiswa']) ?>" placeholder="Nama Mahasiswa" readonly="true" required>
                                        <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                    </div>
                                    <div class="input-group col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-id-card-alt fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="NIM" id="NIM" value="<?php echo ($_POST['Nimmahasiswa']) ?>" placeholder="Nim Mahasiswa" readonly="true" required>
                                        <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card-alt"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="NIM" id="NIM" value="<?php echo ($_POST['Nimmahasiswa']) ?>" placeholder="Judul Perlombaan" required>
                                    
                                </div>
                            </div> -->
                            </div>
                        </div>

                        <div class="card-body" style="padding-top: 0.8rem;">
                            <h3 class="mt-1 col-md-12">Data Prestasi Kompetisi</h3>
                            <div class="row mt-3">
                                <!-- left -->
                                <div class="col-md-12">
                                    <!-- left -->
                                    <!-- <div class="col-md-6"> -->
                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-dice-d20 fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="JudulLomba" id="JudulLomba" placeholder="Judul Perlombaan" required>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-university fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="Penyelenggara" id="Penyelenggara" placeholder="Penyelenggara" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group col-md-6">
                                            <div class="input-group date" id="tanggal" data-target-input="nearest">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar-alt fa-fw"></i>
                                                    </span>
                                                </div>
                                                <input type="text" id="tanggalawal" class="form-control datetimepicker-input" data-target="#tanggal" data-target="#tanggal" data-toggle="datetimepicker" placeholder="Tanggal Mulai" />
                                            </div>
                                        </div>
                                        <!-- <span class="input-group-addon" style="padding: 0px 0px 0px 0px;">to</span> -->

                                        <div class="input-group date col-md-6" id="tanggal2" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                                </span>
                                            </div>
                                            <input type="text" id="tanggalakhir" class="form-control datetimepicker-input" data-target="#tanggal2" data-target="#tanggal2" data-toggle="datetimepicker" placeholder="Tanggal Selesai" />
                                        </div>
                                    </div>


                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-code-branch fa-fw"></span>
                                            </div>
                                        </div>
                                        <select class="form-control" name="Bidang" id="Bidang" required>
                                            <option selected disabled>Pilih Bidang</option>
                                            <?php foreach ($databidang as $value) { ?>
                                                <option value="<?= $value->Bidang ?>"><?= $value->Bidang ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user-friends fa-fw"></span>
                                            </div>
                                        </div>
                                        <select class="form-control" name="Kategori" id="Kategori" required>
                                            <option selected disabled>Pilih Kategori</option>
                                            <option>Individu</option>
                                            <option>Kelompok</option>
                                        </select>
                                    </div>

                                    <!-- Jika Memilih Kelompok -->
                                    <div class="card-body mb-3" id="dataanggota" style="border-style: solid none solid none; padding-top:0.8rem; display: none;">
                                        <div class="input-group col-md-12">
                                            <label>Ketua :</label>
                                        </div>
                                        <div class="input-group mb-1 col-md-12">
                                            <input type="text" class="form-control" name="NamaKetua" id="NamaKetua" readonly="true" placeholder="Nama Ketua">
                                            <input type="text" class="form-control" name="NimKetua" id="NimKetua" readonly="true" placeholder="Nim Ketua">
                                        </div>

                                        <div class="input-group col-md-12">
                                            <label>Anggota :</label>
                                        </div>

                                        <div class="input-group mb-1 col-md-12">
                                            <input type="text" class="form-control" name="NimAnggota" id="NimAnggota" placeholder="Masukkan Nim Anggota" required>
                                            <!-- <button type="button" name="TambahData" id="TambahData" class="btn btn-primary float-right">Tambah Data</button> -->
                                            <input type="button" name="TambahData" id="TambahData" value="Tambah Data" class="btn btn-primary float-right"></input>
                                        </div>

                                        <div class="input-group col-md-12">
                                            <div class="table-responsive">
                                                <table id="anggotaKelompok" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nim Anggota</th>
                                                            <th>Nama Anggota</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                    <!-- <tfoot></tfoot> -->
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end -->

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-globe-americas fa-fw"></span>
                                            </div>
                                        </div>
                                        <select class="form-control" name="Tingkat" id="Tingkat" required>
                                            <option selected disabled>Tingkat</option>
                                            <option>Regional</option>
                                            <option>Provinsi</option>
                                            <option>Nasional</option>
                                            <option>Internasional</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 col-md-12" id="ShowTingkat" style="display: none;">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-university fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="jumlahTingkat" id="jumlahTingkat" required>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-users fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="JumlahPeserta" id="JumlahPeserta" placeholder="Jumlah Peserta" required>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-trophy fa-fw"></span>
                                            </div>
                                        </div>
                                        <select class="form-control" name="Pencapaian" id="Pencapaian" required>
                                            <option selected disabled>Pencapaian</option>
                                            <option>Juara 1</option>
                                            <option>Juara 2</option>
                                            <option>Juara 3</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-newspaper fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="JumlahPenghargaan" id="JumlahPenghargaan" placeholder="Jumlah Penghargaan" required>
                                    </div>

                                    <div class="input-group mb-3 col-md-12">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-link fa-fw"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="berita" id="berita" placeholder="Link Berita" required>
                                    </div>

                                    <div class="input-group col-md-12" style="z-index : 0">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-image fa-fw"></span>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="buktiprestasi" name="buktiprestasi">
                                            <label class="custom-file-label" for="customFile">Bukti Prestasi (SK/Sertifikat/Piagam/dll)</label>
                                        </div>
                                        <div class="input-group" style="color: red;">
                                            <p>*Maksimal Ukuran Gambar (JPG/JPEG) : 1024kb || Maksimal ukuran file (PDF) : 1024 kb</p>
                                        </div>
                                    </div>

                                    <div class="input-group col-md-12" style="z-index : 0">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-image fa-fw"></span>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="dokumentasiKegiatan" name="dokumentasiKegiatan">
                                            <label class="custom-file-label" for="customFile">Dokumentasi Kegiatan</label>
                                        </div>
                                        <div class="input-group" style="color: red;">
                                            <p>*Maksimal Ukuran Gambar (JPG/JPEG) : 1024kb || Maksimal ukuran file (PDF) : 1024 kb</p>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <!-- right
                                <div class="col-md-6">
                                </div> -->

                                </div>
                            </div>

                            <input value="Submit " type="button" id="submitform" name="submit" class="btn btn-primary float-right"></input>
                        </div>
                        <!-- /.card-body -->
                        <?= form_close() ?>
                    </form>
                </div>
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
                <h3 class=" m-t-none m-b">Data Anggota</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="false" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <!-- <?= form_open_multipart('mahasiswa/seleksipage', ['class' => 'form-horizontal']) ?> -->
                        <form>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="namamahasiswa" id="namamahasiswa" placeholder="Nama Anggota" readonly="true">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card-alt"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="Nimmahasiswa" id="Nimmahasiswa" placeholder="Nim Anggota" readonly="true">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card-alt"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="prodi" id="prodi" placeholder="Program Studi" readonly="true">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-university"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="fakultas" id="fakultas" placeholder="Fakultas" readonly="true">
                            </div>

                            <!-- /.col -->
                            <div class="col-4 mt-2 float-right">
                                <input type="hidden" name="detector" id="id_modal">
                                <div class="form-group">
                                    <!-- <div class="col-lg-offset-2 col-lg-10"> -->
                                    <input type="button" id="tambahtotabel" name="datamahasiswa" value="Tambah Data Anggota" class="btn btn-sm btn-success float-right" data-dismiss="modal">
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- <?= form_close() ?> -->
            </div>
        </div>
    </div>
</div>