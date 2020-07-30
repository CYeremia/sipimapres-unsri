<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-right">Tahun <?php echo (int) date('Y') ?> </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box3 bg-info">
                                <div class="inner">
                                    <h3><?= $jumlah[0]->mahasiswa ?></h3>
                                    <p>Mahasiswa</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box3 bg-success">
                                <div class="inner">
                                    <h3><?= $jumlah[1]->kompetisi ?></h3>
                                    <p>Prestasi Kompetisi</p>
                                </div>
                                <div class="icon">
                                    <i class=" nav-icon fas fa-trophy"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box3 bg-warning">
                                <div class="inner">
                                    <h3><?= $jumlah[2]->nonkompetisi ?></h3>
                                    <p>Prestasi Non Kompetisi</p>
                                </div>
                                <div class="icon">
                                    <i class=" nav-icon fas fa-award"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Mahasiswa</h3>
                </div>
                <!-- /.card-header -->
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="perestasikompetisi" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
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

            <!-- BAR CHART -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Penyebaran Prestasi Berdasarkan Fakultas</h3>

                    <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div> -->
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>