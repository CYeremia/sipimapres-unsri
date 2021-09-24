<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?= base_url('assets/dist/img') ?>/logoIkon.png" type="image/x-icon">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <title>Login | Si-mapres</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- sweetalert -->

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
            background-color: rgba(255, 255, 255, 0.2);
            height: 45px;
        }

        [type="checkbox"].filled-in:not(:checked)+label::after {
            border: 2px solid white;
        }
    </style>
</head>

<body>
    <div class="login-page" style="margin-top: 100px;">
        <div class="login-box">
            <div class="card-login" style="box-shadow: none;">
                <div class="login-logo">
                    <a style="margin-top: 0px" href="<?= site_url('login') ?>">
                        <img src="<?= base_url('assets/dist/img/logo-full1.png') ?>" height="1000px" alt="">
                    </a>
                    <!-- <a class="textlogo" href="javascript:void(0);"><b>Si-Pimampres</b></a> -->
                </div>
                <!-- /.login-logo -->
                <div class="card-body login-card-body">

                    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                    <!-- <form class="user" method="POST" action="<?= base_url('login'); ?>"> -->
                    <form id="sign_in">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" id="IDpengenal" name="IDpengenal" placeholder="NIM/ID Pengenal" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 mt-2" style="color: white;">
                                <!-- <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div> -->
                            </div>
                            <!-- /.col -->
                            <div class="col-4 mt-1">
                                <button class="btn btn-block bg-blue waves-effect" id="btSubmit" type="submit">SIGN IN</button>
                                <!-- <button class="btn btn-block" style="color: black; background-color: #D58E60;" id="btSubmit" type="submit">SIGN IN</button>
                                <button class="btn btn-block bg-blue waves-effect" type="submit">SIGN IN</button> -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-0 mt-2">
                        Belum Memiliki Akun?
                        <a class="signup" style="color:orange; font-size:large" href="<?= site_url('signup') ?>">REGISTRASI</a>
                    </p>
			
			<tr>
                        <td style="width: 20%">Panduan penggunaan Simapres</td>
                        <td><a href="<?= base_url() ?>Login/downloadfilePanduan/UserGuide.pdf">Download <i class="fas fa-download"></i></a></td>
                    </tr>
                    <br>
                    <tr>
                        <td style="width: 20%">Panduan penggunaan Bagi Mahasiswa</td>
                        <td><a href="<?= base_url() ?>Login/downloadfilePanduan/UserGuideMhs.pdf">Download <i class="fas fa-download"></i></a></td>
                    </tr>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>

    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <!-- <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script> -->
    <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery-3.5.1.min.js"></script>
    <!-- <script src="<?= base_url('assets') ?>/plugins/jquery-validation/jquery.validate.js"></script> -->

    <!-- Bootstrap 4 -->
    <script ssrc="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>

    <!-- <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- javascript -->
    <script src="<?= base_url('assets') ?>/dist/js/login.js"></script>
</body>

</html>