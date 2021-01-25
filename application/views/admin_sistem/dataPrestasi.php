<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Prestasi Mahasiswa</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card" style="border-style: none none solid none;">
            <div class="card-header">
                <h3 class="card-title">Data Mahasiswa</h3>
                <a class="btn bg-blue float-right" href="<?= base_url() ?>admin_sistem/PeringkatUniv">Peringkat Tertinggi Univ</a>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Nama" id="Nama" value="<?php echo ($IDMahasiswa->Nama) ?>" placeholder="Nama Mahasiswa" readonly=true required>
                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                        </div>

                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Fakultas" id="Fakultas" value="<?php echo ($IDMahasiswa->Fakultas) ?>" placeholder="Fakultas" readonly=true required>
                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card-alt"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="NIM" id="NIM" value="<?php echo ($IDMahasiswa->IDPengenal) ?>" placeholder="NIM" readonly=true required>
                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                        </div>

                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-graduation-cap"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="Prodi" id="Prodi" value="<?php echo ($IDMahasiswa->ProgramStudi) ?>" placeholder="Program Studi" readonly=true required>
                            <!-- <?php print_r($_POST['Nimmahasiswa']) ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class=" card-body">
                <div class="table-responsive">
                    <table id="DataPrestasi" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Pencapaian/Peran</th>
                                <th>TanggalMulai</th>
                                <th>TanggalAkhir</th>
                                <th>Penyelenggara</th>
                                <th>Kategori</th>
                                <th>Tingkat</th>
                                <th>Jumlah Peserta</th>
                                <th>Jumlah Penghargaan</th>
                                <th>Skor</th>
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
        <!-- /.card -->
    </section>
    <!-- section -->
</div>
<!-- /.content -->