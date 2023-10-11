<!DOCTYPE html>
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
          Tambah Data Tabungan
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">
          <div class="box-body ">
            
            <div class="row">
              <div class="col-xs-12">
                <form action="<?php echo base_url() . 'admin/tabungan/create'; ?>" method="post" enctype="multipart/form-data">
                  <?php $id_admin = $this->session->userdata('idadmin'); ?>
                  <input type="hidden" name="user_id" value="<?= $id_admin ?>">
                  <div class="form-group">
                    <label for="jumlah">Jumlah </label>
                    <input type="number" min="100" id="jumlah" name="jumlah" class="form-control" placeholder="Masukkan Jumlah Tabungan" required>
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="form-group">
                    <label for="channel">Channel</label>
                    <select class="form-control" id="channel" name="channel" onchange='CheckColors(this.value);' required >
                      <option value="Bank BCA">Bank BCA</option>
                      <option value="Bank BNI">Bank BNI</option>
                      <option value="Bank BRI">Bank BRI</option>
                      <option value="Bank BSI">Bank BSI</option>
                      <option value="Bank BTN">Bank BTN</option>
                      <option value="Bank Danamon">Bank Danamon</option>
                      <option value="Bank Mega">Bank Mega</option>
                      <option value="Bank Nagari">Bank Nagari</option>
                      <option value="Tunai">Tunai</option>
                      <option value="others">Lainnya</option>
                    </select>
                  </div>
                  <input type="text" class="form-control" name="othercolor" placeholder="Channel Lainnya" id="color_change" style='display:none;' />
                  <a href="<?php echo base_url('admin/tabungan'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                  <button type="submit" class="btn btn-primary btn-flat btn-sm" href=""><span class="fa fa-save"></span> Simpan</button>
                </form>
              </div>
            </div>
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
    function CheckColors(val) {
      var element = document.getElementById('color_change');
      if (val == 'pick a color' || val == 'others')
        element.style.display = 'block';
      else
        element.style.display = 'none';
    }
  </script>

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

</html>