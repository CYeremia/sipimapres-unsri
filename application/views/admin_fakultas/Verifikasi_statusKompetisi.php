<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Verifikasi Data Prestasi Kompetisi</h1>
                </div><!-- /.col -->
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
                        <?= form_open_multipart('admin_fakultas/Verifikasi_status_kompetisi', ['class' => 'form-horizontal']) ?>
                        <table id="verifikasi" style="width:100%" class="table table-bordered table-hover dataTable">
                            <thead></thead>
                            <tbody>
                                <!-- <form role="form"> -->
                                <tr>
                                    <td style="width: 20%">Nama Mahasiswa</td>
                                    <td><?php echo ($NamaM->Nama) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">NIM</td>
                                    <td><?php echo ($IDM->PeraihPrestasi) ?></td>
                                </tr>

                                <tr>
                                    <td style=" width: 20%">Judul Perlombaan</td>
                                    <td><?php echo ($IDM->Perlombaan) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Bidang</td>
                                    <td><?php echo ($IDM->Bidang) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Penyelenggara</td>
                                    <td><?php echo ($IDM->Penyelenggara) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Kategori</td>
                                    <td><?php echo ($IDM->Kategori) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Pencapaian</td>
                                    <td><?php echo ($IDM->Pencapaian) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Tahun</td>
                                    <td><?php echo ($IDM->Tahun) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Tingkat</td>
                                    <td><?php echo ($IDM->Tingkat) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Link Berita</td>
                                    <td><?php echo ($IDM->LinkBerita) ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Bukti Prestasi</td>
                                    <td><img id="bukti" style="width:200px" src="<?= base_url('uploads') ?>/<?= $IDM->BuktiPrestasi ?>"></td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Status</td>
                                    <td>
                                        <div class="input-group">
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
                        <input type="hidden" name="IDPrestasiM" value="<?php echo ($IDM->IDPrestasi) ?> ">
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
            <span aria-hidden="true" style="padding-right: 10px;">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <center><img style="margin-top: 5%; width: auto; height: auto;" class="modal-content" id="img"></center>
    </div>
</div>