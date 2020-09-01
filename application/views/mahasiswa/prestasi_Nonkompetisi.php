<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Prestasi Non Kompetisi</h1>
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
                <div class="header">
                    <?= $this->session->flashdata('msg') ?>
                </div>
                <div class="card-header">
                    <h3 class="card-title">Data Prestasi Non Kompetisi, <?= $userdata->Nama ?></h3>
                    <a class="btn bg-green float-right" href="<?= base_url() ?>mahasiswa/Data_NonKompetisi" class="btn bg-green">Tambah Data</a>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="perestasinonkompetisi" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kegiatan/Produk</th>
                                    <th>Tahun</th>
                                    <th>Penyelenggara</th>
                                    <th>Tingkat</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Detail</th>
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- The Modal -->
<div class="modal" id="Modal-Img">
    <div class="modal-header">
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <!-- <span id="closeimg" class="close">&times;</span> -->
    </div>
    <div class="modal-body">
        <center><img style="margin-top: 5%; width: auto; height: auto;" class="modal-content" id="img"></center>
    </div>
</div>