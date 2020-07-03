<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <title>Login | Si-Pimapres</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- sweetalert -->

    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>



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

    <div class="login-page" style="margin-top: 150px;">
        <div class="login-box">
            <div class="card-login" style="box-shadow: none;">
                <div class="login-logo">
                    <!-- <a style="margin-top: 0px" href="<?= site_url('login') ?>">
                        <img src="<?= base_url('assets/dist/img/Logo.jpeg') ?>" height="1000px" alt="">
                    </a> -->
                    <a class="textlogo" href="javascript:void(0);"><b>Si-Pimampres</b></a>
                </div>
                <!-- /.login-logo -->
                <div class="card-body login-card-body">

                    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                    <form class="user" method="POST" action="<?= base_url('login'); ?>">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" id="IDpengenal" name="IDpengenal" placeholder="NIM/ID Pengenal" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
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
                            <div class="col-8 mb-3" style="color: white;">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button class="btn btn-block bg-blue waves-effect" type="submit">SIGN IN</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-0">
                        Don't have an account?
                        <a class="signup" href="<?= site_url('signup/newUser') ?>">SIGN UP</a>
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
    <!-- javascript -->
    <script src="<?= base_url('assets') ?>/dist/js/login.js"></script>
</body>

</html>