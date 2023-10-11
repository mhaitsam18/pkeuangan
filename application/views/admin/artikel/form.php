<!DOCTYPE html>
<html>

<head>
  <!-- <link rel="stylesheet" href="nama_file.css"> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/select2/select2.min.css' ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
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
          Tambah Data Artikel
          <small></small>
        </h1>
      </section>

      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box">

          <form action="<?php echo base_url() . 'admin/artikel/create'; ?>" method="post" enctype="multipart/form-data">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-12">
                  <fieldset>
                    <legend class="font-17">Form Artikel</legend>
                    <div class="col-md-6">
                      <div class="form-group">
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nama Artikel</label>
                        <input type="text" name="nama" maxlength="150" class="form-control" id="inputUserName" placeholder="Masukan Nama Artikel" required>
                      </div>
                      <input type="hidden" value="<?= date('d-m-Y'); ?>" name="tanggal">
                      <div class="form-group">
                        <label for="">Detail</label>
                        <textarea id="editor" name="detail"></textarea>
                      </div>
                      <div class="form-group">
                        <fieldset>
                          <legend class="font-17">Tambah Gambar</legend>
                          <input type="file" name="images">
                        </fieldset>
                      </div>
                      <div class="form-group">
                        <label for="youtube">URL YouTube</label>
                        <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Ex: https://youtu.be/FM7MFYoylVs">
                        <!-- <small class=" text-primary">
                          Ambil bagian Belakang URL Youtube Contoh : <br>
                          <s>https://youtu.be/</s>FM7MFYoylVs
                        </small> -->
                      </div>
                      <!-- <div class=" row">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-5">
                          <label for="">Contoh</label>
                          <img src="<?= base_url('assets/img/tutorial.png') ?>" alt="">
                        </div>
                      </div> -->
                      <br><br><br>
                    </div>
                </div>
                </fieldset>
              </div>
              <!-- End Informasi Umum -->
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url('admin/artikel'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
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
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/ckeditor/ckeditor.js' ?>"></script>
  <!-- summernote -->
  <script src="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url() . 'assets/plugins/select2/select2.full.min.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() . 'assets/plugins/iCheck/icheck.min.js' ?>"></script>

  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>

  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
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