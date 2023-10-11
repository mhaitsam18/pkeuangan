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
          Profil
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/profile/update_pengguna' ?>" method="post" enctype="multipart/form-data">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-6">
                  <fieldset>
                    <legend class="font-17">Profil Formulir</legend>
                    <div class="col-md-6">
                      <div class="form-group">
                        </select>
                        <?php
                        $id_admin = $this->session->userdata('idadmin');
                        $q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
                        $c = $q->row_array();
                        ?>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="kode" value="<?= $c['pengguna_id']; ?>">
                        <label for="namaLengkap"> Nama Lengkap </label>
                        <input type="text" name="xnama" class="form-control" id="inputUserName" value="<?= $c['pengguna_nama']; ?>" placeholder="Masukan Nama" required>
                      </div>
                      <div class="form-group">
                        <?php if ($c['pengguna_jenkel'] == 'L') : ?>
                          <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                          <label for="inlineRadio2"> Laki-Laki </label>
                          <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                          <label for="inlineRadio2"> Perempuan </label>
                        <?php else : ?>
                          <input type="radio" id="inlineRadio1" value="L" name="xjenkel">
                          <label for="inlineRadio2"> Laki-Laki </label>
                          <input type="radio" id="inlineRadio1" value="P" name="xjenkel" checked>
                          <label for="inlineRadio2"> Perempuan </label>
                        <?php endif ?>
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="xusername" class="form-control" id="inputUserName" value="<?= $c['pengguna_username']; ?>" placeholder="Masukan Username" required>
                      </div>
                      <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" name="xkontak" class="form-control" id="inputnohp" value="<?= $c['pengguna_nohp']; ?>" placeholder="Masukan No. Hp" required>
                        <input type="hidden" name="xlevel" value="<?= $c['pengguna_level']; ?>">
                      </div>
                      <br><br><br>
                    </div>
                </div>
                </fieldset>

                <fieldset>
                  <legend class="font-17">Profil Formulir</legend>
                  <div class="col-md-6">
                    <div class="form-group">
                      </select>
                      <?php
                      $id_admin = $this->session->userdata('idadmin');
                      $q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
                      $c = $q->row_array();
                      ?>
                    </div>
                    <div class="form-group">
                      <label>Password Baru</label>
                      <input type="password" name="xpassword" class="form-control" id="inputUserName" placeholder="Masukan Password Baru">
                    </div>
                    <div class="form-group">
                      <label>Ulang Password</label>
                      <input type="password" name="xpassword2" class="form-control" id="inputUserName" placeholder="Konfirmasi Password Baru">
                    </div>
                    <div class="form-group">
                      <fieldset>
                        <legend class="font-17">Ubah Foto</legend>
                        <input type="file" name="filefoto" id="filefoto">
                      </fieldset>
                    </div>
                    <img src="<?php echo base_url() . 'assets/images/' . $c['pengguna_photo']; ?>" width="155px" alt="">
                    <br><br><br>
                  </div>
              </div>
              </fieldset>
              <!-- End Informasi Umum -->

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat btn-sm" href=""><span class="fa fa-save"></span> Simpan</button>

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