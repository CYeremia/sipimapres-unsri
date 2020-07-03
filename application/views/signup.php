<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <title>Sign Up | Si-Pimapres</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/custom.css">

    <style>
        html,
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?= base_url('assets') ?>/dist/img/Unsri-bg.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .card-login {
            background-color: rgba(0, 0, 0, 0.2);
        }

        [type="checkbox"].filled-in:not(:checked)+label::after {
            border: 2px solid white;
        }
    </style>
</head>

<body>

    <div class="login-page" style="margin-top: 200px;">
        <div class="login-box">
            <div class="card-login" style="box-shadow: none;">
                <div class="login-logo">
                    <!-- <a style="margin-top: 0px" href="<?= site_url('login') ?>">
                        <img src="<?= base_url('assets/dist/img/Logo.jpeg') ?>" height="1000px" alt="">
                    </a> -->
                    <a class="textlogo" href="javascript:void(0);"><b>Si-Pimampres</b></a>
                </div>
                <!-- /.login-logo -->

                <div class="card-body">
                    <?= form_open_multipart('signup/newUser', ['class' => 'form-horizontal']) ?>
                    <!-- <form id="sign_up"> -->
                    <input type="hidden" name="id" id="id">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" required>
                        <!-- <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div> -->
                    </div>
                    <div class="input-group mb-4">
                        <!-- <div class="col-md-6 mb-4"> -->
                        <input type="text" class="form-control" name="IDpengenal" id="IDpengenal" placeholder="Nim/ID Pengenal">
                        <!-- <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div> -->
                        <!-- </div> -->
                    </div>

                    <div class="row">
                        <!-- left -->
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                <!-- <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div> -->
                            </div>

                            <!-- <div class="input-group mb-4">
                                    <select class="form-control" placeholder="IPK">
                                        <option>Fakultas</option>
                                        <option>Fakultas Ilmu Komputer</option>
                                        <option>Fakultas Ekonomi</option>
                                        <option>Fakultas Hukum</option>
                                    </select>
                                </div> -->
                        </div>

                        <!-- right -->
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <!-- <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="telp" id="telp" placeholder="Telphone">
                        <!-- <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div> -->
                    </div>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="IPK" id="IPK" placeholder="IPK">
                        <!-- <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div> -->
                    </div>

                    <div class="input-group mb-4">
                        <select class="form-control" name="role" id="role" placeholder="Jurusan">
                            <option selected disabled>Pilih Role</option>
                            <option>Admin</option>
                            <option>Admin Fakultas</option>
                            <option>Mahasiswa</option>
                        </select>
                    </div>

                    <div class="input-group mb-4">
                        <select class="form-control" name="fakultas" id="fakultas" placeholder="Fakultas">
                            <option selected disabled>Pilih Fakultas</option>
                            <option>Fakultas Ilmu Komputer</option>
                            <option>Fakultas Ekonomi</option>
                            <option>Fakultas Hukum</option>
                        </select>
                    </div>

                    <div class="input-group mb-4">
                        <select class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan">
                            <option selected disabled>Pilih Prodi</option>
                            <option>Teknik Informatika (S1)</option>
                            <option>Teknik Informatika Bilingual</option>
                            <option>Sistem Informasi Bilingual</option>
                            <option>Sistem Komputer Bilingual</option>
                            <option>Teknik Informatika</option>
                            <option>Sistem Informasi</option>
                            <option>Sistem Komputer</option>
                        </select>
                    </div>

                    <!-- <div class="mb-4"> -->
                    <input class="btn btn-block bg-blue waves-effect" name="signup" id="signup" type="submit"></input>
                    <!-- </div> -->
                    <?= form_close() ?>

                    <!-- </form> -->

                    <p class="mt-4 mb-0">
                        <a class="signup" id="login" href="<?= site_url('login') ?>">I already have a account</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>

    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script ssrc="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
</body>

</html>