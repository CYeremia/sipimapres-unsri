<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Analisis Peringkat Fakultas</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Filter Peringkat Fakultas</h3>
                    </div>
                    <div class="card-body">
                        <!-- Year and Faculty range -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <select class="form-control" name="tahun" id="tahun" required>
                                </select>
                                <span class="input-group-addon" style="padding: 0px 10px 0px 10px;">to</span>
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div> -->
                                <select class="form-control" name="tahun2" id="tahun2" required>
                                </select>
                            </div>
                        </div>
                        <!-- /.input group -->

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-university"></i>
                                    </span>
                                </div>
                                <select name="fakultas" id="fakultas" class="form-control show-tick" required>
                                    <option selected disabled>Pilih Fakultas</option>
                                    <?php foreach ($fakultas as $value) { ?>
                                        <option value="<?= $value->Fakultas ?>"><?= $value->Fakultas ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.input group -->

                        <button type="button" id="filter" style="margin-right:2em; " class="btn bg-green waves-effect">APPLY FILTER</button>
                        <button type="button" id="resetfilter" class="btn bg-red waves-effect">RESET FILTER</button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Peringkat Fakultas Berdasarkan Prestasi</h3>
            </div>
            <!-- /.card-header -->
            <div class=" card-body">
                <div class="table-responsive">
                    <table id="perestasikompetisi" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Fakultas</th>
                                <th>Jumlah Prestasi Kompetisi</th>
                                <th>Jumlah Prestasi Non Kompetisi</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fakultas Ilmu Komputer</td>
                                <td>150</td>
                                <td>50</td>
                                <td>200</td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Peringkat Fakultas Berdasarkan Mahasiswa Berprestasi</h3>
            </div>
            <!-- /.card-header -->
            <div class=" card-body">
                <div class="table-responsive">
                    <table id="perestasikompetisimahasiswa" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Fakultas</th>
                                <th>Jumlah Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fakultas Ilmu Komputer</td>
                                <td>200</td>
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