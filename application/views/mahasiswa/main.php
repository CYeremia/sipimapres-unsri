<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch" style="max-width: 540%;">
                        <div class="row col-md-12">
                            <div class="col-md-2 text-center">
                                <img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body p-0">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead></thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 15%">Nama </td>
                                                    <td><?= $user['Nama'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Nim </td>
                                                    <td><?= $user['IDPengenal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Program Studi </td>
                                                    <td><?= $user['ProgramStudi'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Fakultas </td>
                                                    <td><?= $user['Fakultas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">Email </td>
                                                    <td><?= $user['Email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">IPK </td>
                                                    <td><?= $user['IPK'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 15%">No. Telp </td>
                                                    <td><?= $user['Telephone'] ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">

                </div>

            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>