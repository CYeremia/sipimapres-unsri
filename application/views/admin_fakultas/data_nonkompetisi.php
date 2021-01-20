<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Prestasi Kompetisi</h1>
                </div> -->
    <!-- /.col -->
    <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>/.col -->
    <!-- </div> -->
    <!-- /.row -->
    <!-- </div> -->
    <!-- /.container-fluid -->
    <!-- </div> -->
    <!-- /.content-header -->

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
                    <?= form_open_multipart('admin_fakultas/Data_NonKompetisi', ['class' => 'form-horizontal']) ?>
                    <!-- <form role="form"> -->
                    <div class="card-body" style="border-style: none none solid none;">
                        <h3 class="mt-1">Data Mahasiswa</h3>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="Nama" id="Nama" value="<?php echo ($_POST['namamahasiswa']) ?>" placeholder="Nama Mahasiswa" readonly=true required>
                                    <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                </div>

                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-card-alt fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="NIM" id="NIM" value="<?php echo ($_POST['Nimmahasiswa']) ?>" placeholder="NIM Mahasiswa" readonly=true required>
                                    <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" style="padding-top: 0.8rem;">
                        <h3 class="mt-1">Data Prestasi Non Kompetisi</h3>
                        <div class="row mt-3">

                            <!-- left -->
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-dice-d20 fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="JudulLomba" id="JudulLomba" placeholder="Judul Perlombaan" required>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-university fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="Penyelenggara" id="Penyelenggara" placeholder="Penyelenggara" required>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-calendar-alt fa-fw"></span>
                                        </div>
                                    </div>
                                    <select class="form-control" name="tahun" id="tahun" required>
                                    </select>
                                </div>

                                <div class="input-group mb-4">
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

                                <div class="input-group mb-4">
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

                                <div class="input-group mb-4" id="peran">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-street-view fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="Peran" id="Peran" placeholder="Peran / Pengakuan">
                                </div>

                                <div class="input-group mb-0" style="display: none;" id="jabatan">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-street-view fa-fw"></span>
                                        </div>
                                    </div>
                                    <select class="form-control" name="peran_organisasi" id="peran_organisasi">
                                        <option selected disabled>Pilih Jabatan</option>
                                        <option>Ketua</option>
                                        <option>Pengurus Harian</option>
                                    </select>
                                    <div class="input-group" style="color: red;">
                                        <p>*Pengurus Harian : Sekretaris/Bendahara/Pembantu Umum / Ketua Panitia Kegiatan</p>
                                    </div>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-globe-americas fa-fw"></span>
                                        </div>
                                    </div>
                                    <select class="form-control" name="Tingkat" id="Tingkat" required>
                                        <option selected disabled>Pilih Tingkat</option>
                                    </select>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-users fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="JumlahPeserta" id="JumlahPeserta" placeholder="Jumlah Peserta" required>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-newspaper fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="JumlahPenghargaan" id="JumlahPenghargaan" placeholder="Jumlah Penghargaan" required>
                                </div>

                                <div class="input-group mb-4">
                                    <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-link fa-fw"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="berita" id="berita" placeholder="Link Berita">
                                </div>

                                <div class="input-group mb-4" style="z-index : 0">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-image fa-fw"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="buktiprestasi" name="buktiprestasi">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <div class="input-group" style="color: red;">
                                        <p>*Maksimal Ukuran Gambar (JPG/JPEG) : 1024kb</p>
                                    </div>
                                </div>
                            </div>


                            <!-- right -->
                            <!-- <div class="col-md-6">
                            </div> -->

                        </div>

                        <input type="submit" name="submit" class="btn btn-primary float-right"></input>
                    </div>
                    <!-- /.card-body -->
                    <?= form_close() ?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>