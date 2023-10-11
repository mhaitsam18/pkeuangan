<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=<!DOCTYPE html">
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME; ?></title>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/select2/select2.min.css' ?>">
    <?php $this->load->view('/admin/template/metafile'); ?>
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/iCheck/square/blue.css' ?>">

  </head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
  <div class="wrapper">

    <!--Header-->
    <?php $this->load->view('/admin/template/header'); ?>

    <!--sidebar-->
    <?php $this->load->view('/admin/template/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Ubah Data Hutang
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/hutang/bayar/' . $item->id; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="hutang_id" value="<?= $item->id ?>">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-6">
                  <fieldset>
                    <legend class="font-17">Hutang</legend>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah Hutang</label>
                        <input type="number" name="jumlah_hutang" class="form-control" id="inputUserName" placeholder="" value="<?php echo $item->jumlah ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Jumlah Bayar</label>
                        <input type="number" min="1000" max="<?php echo $item->jumlah ?>" name="jumlah_bayar" class="form-control" id="inputUserName" placeholder="Jumlah Pembayaran" required>
                      </div>
                  </fieldset>
                </div>
                <!-- End Informasi Umum -->
                <hr>
                <div class="row">
                  <div class="col-md-4">

                  </div>
                </div>
              </div>
              <div class="box-footer">
                <a href="<?php echo base_url('admin/hutang'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                <button type="submit" class="btn btn-primary btn-flat btn-sm" name="submit" value="Submit"><span class="fa fa-save"></span> Bayar</button>
              </div>
            </div>
            <!-- /.box -->

            <div class="row">
              <div class="col-md-8">
                <!-- /.box -->

              </div>
              <!-- /.col (left) -->
              <div class="col-md-4">
                <!-- /.box -->
          </form>

          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
    </div>
    <!-- /.row -->

    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('/admin/template/footer'); ?>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/ckeditor/ckeditor.js' ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url() . 'assets/plugins/select2/select2.full.min.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() . 'assets/plugins/iCheck/icheck.min.js' ?>"></script>

  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>

  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });

      $(".select2").select2();

    });
  </script>
  <?php $this->load->view('/admin/template/notice'); ?>
</body>

</html>, initial-scale=1.0">
<title>Document</title>
</head>

<body>

</body>

</html>