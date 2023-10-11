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
          Tambah Data RAB
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">
          <div class="box-body ">

            <div class="row">
              <div class="col-md-4">
                <form action="<?php echo base_url() . 'admin/rab/create'; ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="pemasukan" name="pemasukan" value="<?= $pemasukan ?>">
                  <div class="form-group">
                    <label>Nama RAB</label>
                    <input type="hidden" name="user_id" value="<?php $id_admin = $this->session->userdata('idadmin');
                                                                echo $id_admin ?>">
                    <input type="name" name="nama" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control" required>
                      <option value="" selected disabled>Pilih Bulan</option>
                      <?php for ($i = 1; $i < 12; $i++) { ?>
                        <option value="<?= $i ?>" <?= ($i == $bulan) ? 'selected' : '' ?>><?= cari_bulan($i) ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" name="persen_total" id="persen_total" class="form-control" require value="<?= $totalPersen ?>">
                  <div class="form-group">
                    <label>Nominal</label>
                    <input type="number" name="nominal" class="form-control" id="nominal" required>
                  </div>
                  <div class="form-group">
                    <label>Persentase</label>
                    <input type="number" step="0.01" name="persen" max="<?= 100 - $totalPersen ?>" class="form-control" id="persen" required>
                  </div>
                  <div class="form-group">
                    <label>Minimal</label>
                    <input type="number" step="0.01" name="min" max="100" class="form-control" id="min" value="0" readonly>
                  </div>
                  <div class="form-group">
                    <label>Maksimal</label>
                    <input type="number" step="0.01" name="max" max="100" class="form-control" id="max" value="<?= 100 - $totalPersen ?>" readonly>
                  </div>
                  <?php if ($totalPersen < 100) : ?>
                    <button type="submit" class="btn btn-primary btn-flat btn-sm" id="simpan"><span class="fa fa-save"></span> Simpan</button>
                  <?php else : ?>
                    <a class="btn btn-primary btn-flat btn-sm disabled"><span class="fa fa-save" id="simpan"></span> Simpan</a>
                  <?php endif ?>
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
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
    $("#bulan").on('change', function() {
      var bulan = $(this).val();
      $.ajax({
        url: "<?= base_url('admin/rab/rabBulan') ?>",
        type: "post",
        dataType: 'json',
        data: {
          'bulan': bulan
        },
        success: function(data) {
          if (data.total_persen < 100) {
            $("#simpan").attr("class", "btn btn-primary btn-flat btn-sm");
          } else {
            $("#simpan").attr("class", "btn btn-primary btn-flat btn-sm disabled");
          }
        }
      });
    });
  </script>
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
            $('#persen').val(data);
          }
        });
      }
    });

    $("#persen").keyup(function() {
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
  </script>
  <?php $this->load->view('/admin/template/notice'); ?>
</body>

</html>