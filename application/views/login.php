<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login | Aplikasi Persediaan</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Persediaan Barang dengan PHP7 dan MySQLi">
  <meta name="author" content="Indra Styawantoro" />

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png" />

  <!-- Bootstrap 3.3.2 -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="<?php echo base_url() ?>assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url() ?>assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />
  <style>
    /* .login-box-body {
      position: relative;
    }

    .login-box-body>.logo {
      --height: 100px;
      --width: 100px;
      border-radius: 50%;
      background: #fff;
      position: absolute;
      top: calc(var(--height) * 0.5 * -1);
      left: calc(50% - (0.5*var(--width)));
      height: var(--height);
      width: var(--width);
    } */

    .login-box-msg {
      border: 0px;
      position: relative;
      z-index: 3;
      opacity: 0.5;
    }

    .login-box-msg::before {
      content: '';
      width: 100%;
      position: absolute;
      top: 40%;
      left: 0;
      border-bottom: #b1b1b1 1px solid;
      z-index: -1;
    }
  </style>
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/sys/logo-transparent.png') ?>">
</head>

<body class="login-page bg-login">
  <div class="login-box">
    <div style="color:#e49520" class="login-logo">
      <b> Aplikasi
        <br>Gudang Oricow</b>
    </div><!-- /.login-logo -->
    <?php
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    }
    // jika alert = 1
    // tampilkan pesan Gagal "Username atau Password salah, cek kembali Username dan Password Anda"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-times-circle'></i> Gagal Login!</h4>
                Username atau Password salah, cek kembali Username dan Password Anda.
              </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Anda telah berhasil logout"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Anda telah berhasil logout.
              </div>";
    }
    ?>

    <div class="login-box-body" style="border-color: #D04848;">
      <div style="text-align: center;">
        <img src="<?= base_url('assets/images/sys/logo-transparent.png') ?>" style="height: 100px; width: 100px;" alt="">
      </div>
      <br>
      <p class="login-box-msg">
        <span style="background: #fff; padding: 3px;">
          <i class="fa fa-user icon-title"></i> Silahkan Login
        </span>
      </p>
      <br />
      <?php if (isset($_SESSION['danger'])) : ?>
        <div class="alert alert-danger" role="alert"><?= $_SESSION['danger'] ?></div>
      <?php endif ?>
      <form action="<?php echo base_url() ?>home/login" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12">
            <input type="submit" class="btn btn-warning btn-lg btn-block" style="background: #D04848;" name="login" value="Login" />
          </div><!-- /.col -->
        </div>
      </form>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- jQuery 2.1.3 -->
  <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>