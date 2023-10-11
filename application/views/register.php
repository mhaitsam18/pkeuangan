<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?> | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url(); ?>assets/images/m.png">
  <!-- Bootstrap 3.3.6 -->
  <!-- <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/iCheck/square/blue.css' ?>">
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/custom.css' ?>">

</head>

<body class="hold-transition login-page">
  <div class="login-box" style="width:50%;">
    <div>
      <p><?php echo $this->session->flashdata('msg'); ?></p>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"> <img src="<?php echo base_url(); ?>assets/images/m.png" width="250px"><br><b>
          <center class="font-17"><?php echo APP_NAME; ?></center>
        </b></p>

      <hr />

      <form action="<?php echo base_url() . 'auth/registerPost' ?>" method="post" enctype="multipart/form-data">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="nama" class="form-control" placeholder="Nama" required>
        </div>
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group has-feedback">
          <input type="number" name="no_ktp" class="form-control" placeholder="Nomor KTP" required>
        </div>
        <div class="form-group has-feedback">
          <label for="">Foto KTP</label>
          <input type="file" name="foto_ktp" class="form-control" required>
        </div>
        <div class="form-group has-feedback">
          <label for="">Foto</label>
          <input type="file" name="photo" class="form-control" required>
        </div>
        <div class="form-group has-feedback">
          <input type="number" name="phone" class="form-control" placeholder="Phone" required>
        </div>
        <div class="form-group has-feedback">
          <input type="radio" name="jenkel" class="form-control" value="L" required> Laki-laki
          <input type="radio" name="jenkel" class="form-control" value="P"> Perempuan
        </div>
        <div class="row">
          <div class="col-xs-8">
            Sudah Memiliki Akun? <a href="<?= base_url() ?>auth">Login Disini!!</a>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->
      <hr />
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() . 'assets/plugins/iCheck/icheck.min.js' ?>"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });
    });
  </script>
</body>

</html>