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
          Ubah Data Pengeluaran
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/pengeluaran/update/' . $item->id; ?>" method="post" enctype="multipart/form-data">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-6">
                  <fieldset>
                    <legend class="font-17">Pengeluaran</legend>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" min="1000" name="jumlah" class="form-control" id="inputUserName" placeholder="Ubah Pengeluaran" required value="<?php echo $item->jumlah ?>">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="detail" name="keterangan" rows="4" cols="50" placeholder="Masukkan keterangan" required><?php echo $item->keterangan ?></textarea>
                      </div>
                      <label>Tanggal</label>
                      <input class="form-control" z type="date" name="tanggal" value="<?= $item->tanggal ?>" required>

                      <div class="col-md-6">

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
                <?php
                $data = $this->db->query("select * from pengeluaran where id = " . $item->id)->row();
                $rab_id = $data->rab_id;
                $nama_rab = $this->db->query("select * from rab where id = $rab_id")->row();
                $nama = $nama_rab->nama;
                ?>
                <a href="<?php echo base_url('admin/pengeluaran/page/' . $rab_id . '/' . $nama); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>

                <input type="hidden" name="nama_rab" value="<?= $nama ?>">
                <button type="submit" class="btn btn-primary btn-flat btn-sm" href="<?php echo base_url('admin/pengeluaran/update;') ?>"><span class="fa fa-save"></span> Simpan</button>

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

</html>