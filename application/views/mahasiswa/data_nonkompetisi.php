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
                <?= form_open_multipart('mahasiswa/Data_NonKompetisi', ['class' => 'form-horizontal']) ?>
                <!-- <form role="form"> -->
                <div class="card-body">
                    <div class="row">

                        <!-- left -->
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-dice-d20"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="JudulLomba" id="JudulLomba" placeholder="Judul Perlombaan" required>
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-university"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="Penyelenggara" id="Penyelenggara" placeholder="Penyelenggara" required>
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-users"></span>
                                    </div>
                                </div>
                                <select class="form-control" name="Kategori" id="Kategori" required>
                                    <option selected disabled>Kategori</option>
                                    <option>Individu</option>
                                    <option>Kelompok</option>
                                </select>
                            </div>

                            <div class="input-group mb-4">
                                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label> -->
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-link"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="berita" id="berita" placeholder="Link Berita" required>
                            </div>


                        </div>


                        <!-- right -->
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <!-- <span class="fas fa-people-arrows"></span> -->
                                        <span class="fas fa-street-view"></span>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="Peran" id="Peran" placeholder="Peran / Pengakuan" required>
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-calendar-alt"></span>
                                    </div>
                                </div>
                                <select class="form-control" name="tahun" id="tahun" required>
                                </select>
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-globe-americas"></span>
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

                            <div class="input-group mb-4" style="z-index : 0">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-image"></span>
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="buktiprestasi" name="buktiprestasi">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                        </div>

                    </div>


                    <input type="submit" name="submit" class="btn btn-primary float-right"></input>
                </div>
                <!-- /.card-body -->
                <?= form_close() ?>
            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>