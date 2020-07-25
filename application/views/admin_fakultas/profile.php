<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
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
            <div class="header">
                <?= $this->session->flashdata('msg') ?>
            </div>
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
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
                                                <table id="profile" class="table table-striped">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 10%" colspan="3">
                                                                <h4 style="display: inline-block; top: 10px;"><b>Detail Data</b></h4>
                                                                <button id=<?= $userdata->IDPengenal ?> class="btn bg-blue float-right editPassword" style="margin-right:10px;">Change Password</button>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%"><b> Nama</b> </td>
                                                            <td><?= $userdata->Nama ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%"><b>ID Pegawai </b></td>
                                                            <td><?= $userdata->IDPengenal ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%"><b>Fakultas </b></td>
                                                            <td><?= $userdata->Fakultas ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%"><b>Email</b></td>
                                                            <td><?= $userdata->Email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20%"><b>No. Telp<b></td>
                                                            <td><?= $userdata->Telephone ?></td>
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
                </section>
                <!-- /.Left col -->
            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div id="modal-form3" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-style: none none solid none;">
                <h3 class=" m-t-none m-b">Change Password</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:black">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- <div class="row"> -->
                    <?= form_open_multipart('admin_fakultas/editPassword', ['class' => 'form-horizontal']) ?>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm New Password" required>
                    </div>
                    <!-- </div> -->

                    <div class="col-4 mt-2 float-right">
                        <input type="hidden" name="detector" id="id_modal2">
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="submit" name="ubahpassword" value="Change Password" class="btn btn-sm btn-success pull-right">
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>