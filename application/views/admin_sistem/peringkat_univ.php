<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Peringkat Tertinggi Universitas</h1>
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
                        <h3 class="card-title">Filter Peringkat Tertinggi Universitas</h3>
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
                                <!-- <span class="input-group-addon" style="padding: 0px 10px 0px 10px;">to</span> -->
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div> -->
                                <!-- <select class="form-control" name="tahun2" id="tahun2" required> -->
                                <!-- </select> -->
                            </div>
                        </div>
                        <!-- /.input group -->

                        <button type="button" id="filterperingkat" style="margin-right:2em; " class="btn bg-green waves-effect">APPLY FILTER</button>
                        <button type="button" id="resetperingkat" class="btn bg-red waves-effect">RESET FILTER</button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Peringkat Mahasiswa Tertinggi</h3>
            </div>
            <!-- /.card-header -->
            <div class=" card-body">
                <div class="table-responsive">
                    <table id="peringkatUn" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Skor</th>
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
        <!-- /.card -->
    </section>
    <!-- section -->
</div>
<!-- /.content -->