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
          Ubah Data RAB
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/rab/update/' . $item->id ?>" method="post" enctype="multipart/form-data">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-6">
                  <fieldset>
                    <legend class="font-17">RAB</legend>
                    <div class="col-md-9">
                      <div class="form-group">
                        <input type="hidden" name="tahun" id="tahun" value="<?= $item->tahun ?>">
                        <input type="hidden" name="bulan" id="bulan" value="<?= $item->bulan ?>">
                        <input type="hidden" name="pemasukan" id="pemasukan" value="<?= $pemasukan ?>">
                        <label>Nama RAB</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $item->nama ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Bulan</label>
                        <input type="text" name="bulanteks" class="form-control" id="bulanteks" value="<?= cari_bulan($item->bulan) ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" class="form-control" id="nominal" placeholder="Nominal" value="<?= $nominal ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Persentase</label>
                        <input type="number" step="0.01" name="persen" class="form-control" id="persentase" placeholder="Persentase" value="<?php echo $item->persen ?>" required>
                      </div>
                      <div class="form-group">
                        <label>Minimal</label>
                        <input type="number" name="min" class="form-control" id="min" placeholder="Minimal" value="<?php echo $item->min ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Maksimal</label>
                        <input type="number" name="max" class="form-control" id="max" placeholder="Maksimal" value="<?= 100 - $totalPersen + $item->persen ?>" readonly>
                      </div>
                    </div>
                    <div class=" col-md-3">
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
                <a href="<?php echo base_url('admin/rab'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                <button type="submit" class="btn btn-primary btn-flat btn-sm" id="submitForm"><span class="fa fa-save"></span> Simpan</button>

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
  <!-- <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    $("#nominal").keyup(function() {
      const nominal = $(this).val();
      const pemasukan = $("#pemasukan").val();
      if (nominal) {
        $.ajax({
          url: "<?= base_url('admin/rab/persentase') ?>",
          type: "post",
          data: {
            'nominal': nominal,
            'pemasukan': pemasukan,
          },
          success: function(data) {
            $('#persentase').val(data);
          }
        });
      }
    });

    $("#persentase").keyup(function() {
      const persentase = $(this).val();
      const pemasukan = $("#pemasukan").val();
      if (persentase) {
        $.ajax({
          url: "<?= base_url('admin/rab/nominal') ?>",
          type: "post",
          data: {
            'persentase': persentase,
            'pemasukan': pemasukan,
          },
          success: function(data) {
            $('#nominal').val(data);
          }
        });
      }
    });

    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });
    });
  </script>
  <?php $this->load->view('/admin/template/notice'); ?>
</body>

</html>