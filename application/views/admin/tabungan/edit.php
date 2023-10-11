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
          Ubah Data Tabungan
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/tabungan/update/' . $item->id; ?>" method="post" enctype="multipart/form-data">
            <?php $id_admin = $this->session->userdata('idadmin'); ?>
            <input type="hidden" name="user_id" value="<?= $id_admin ?>">
            <input type="hidden" name="pengeluaran_id" value="<?= $item->pengeluaran_id ?>">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-xs-12">
                  <fieldset>
                    <legend class="font-17">Tabungan</legend>
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" min="100" name="jumlah" class="form-control" id="inputUserName" placeholder="Masukan Jumlah Tabungan" value="<?php echo $item->jumlah ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea id="detail" name="keterangan" rows="4" cols="50" class="form-control">
                      <?php echo $item->keterangan ?>
                        </textarea>
                    </div>
                    <!-- <div class="form-group">
                        <?php if ($item->penyimpanan == 'Investasi') : ?>
                          <input type="radio" id="inlineRadio1" value="Investasi" name="penyimpanan" checked>
                          <label for="inlineRadio2"> Investasi </label>
                          <input type="radio" id="inlineRadio1" value="tabungan" name="penyimpanan">
                          <label for="inlineRadio2"> Tabungan </label>
                        <?php else : ?>
                          <input type="radio" id="inlineRadio1" value="Investasi" name="penyimpanan">
                          <label for="inlineRadio2"> Investasi </label>
                          <input type="radio" id="inlineRadio1" value="tabungan" name="penyimpanan" checked>
                          <label for="inlineRadio2"> Tabungan </label>
                        <?php endif ?>
                      </div> -->
                    <div class="form-group">
                      <label>Tanggal</label>
                      <input class="form-control" type="date" value="<?= $item->tanggal ?>" name="tanggal" required>
                    </div>
                    <div class="form-group">
                      <label>Channel</label>
                      <select class="form-control" name="channel" onchange='CheckColors(this.value);'>
                        <option value="<?= $item->channel ?>"><?= $item->channel ?></option>
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
                    <input type="text" class="form-control" name="othercolor" placeholder="Channel Lainnya" id="color_change" style="display:none;" />
                  </fieldset>
                  <!-- End Informasi Umum -->

                  <hr>
                </div>
              </div>
              <!-- /.box -->
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url('admin/tabungan'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
              <button type="submit" class="btn btn-primary btn-flat btn-sm" href="<?php echo base_url('admin/tabungan/update;') ?>"><span class="fa fa-save"></span> Simpan</button>
            </div>
          </form>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </section>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('/admin/template/footer'); ?>

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
    $selectedColor = ($_POST['channel'] == "others") ? $_POST['othercolor'] : $_POST['channel'];

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