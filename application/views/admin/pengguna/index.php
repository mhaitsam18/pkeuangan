<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>

  <?php $this->load->view('/admin/template/metafile'); ?>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />
  <script type="text/javascript">

  </script>
</head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('/admin/template/header'); ?>
    <?php $this->load->view('/admin/template/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data Pengguna
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">

              <div class="box">
                <div class="box-header">
                  <a class="btn btn-primary btn-flat btn-sm pull-right" data-toggle="modal" data-target="#myModal"><span class="fa fa-user-plus"></span> Tambah Pengguna</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Nomor KTP</th>
                        <th>Foto KTP</th>
                        <th>Jenis Kelamin</th>
                        <!-- <th>Password</th> -->
                        <th>Kontak</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="text-align:center;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data->result_array() as $i) :
                        $pengguna_id = $i['pengguna_id'];
                        $pengguna_nama = $i['pengguna_nama'];
                        $pengguna_no_ktp = $i['pengguna_no_ktp'];
                        $pengguna_foto_ktp = $i['pengguna_foto_ktp'];
                        $pengguna_jenkel = $i['pengguna_jenkel'];
                        $pengguna_username = $i['pengguna_username'];
                        $pengguna_password = $i['pengguna_password'];
                        $pengguna_nohp = $i['pengguna_nohp'];
                        $pengguna_level = $i['pengguna_level'];
                        $pengguna_status = $i['pengguna_status'];
                        $pengguna_photo = $i['pengguna_photo'];
                        $tanggal_aktif = $i['tanggal_aktif'];
                        $tanggal_nonaktif = $i['tanggal_nonaktif'];
                        $sisa_ban = 0;
                        if ($tanggal_nonaktif && $tanggal_aktif) {
                          $tgl1 = new DateTime($tanggal_nonaktif);
                          $tgl2 = new DateTime($tanggal_aktif);
                          $tgl3 = new DateTime(date('Y-m-d'));
                          if (date('Y-m-d') >= $tanggal_aktif) {
                            $update = [
                              'tanggal_nonaktif' => null,
                              'tanggal_aktif' => null,
                              'pengguna_status' => 1,
                            ];

                            $this->db->where('pengguna_id', $pengguna_id);
                            $this->db->update('tbl_pengguna', $update);
                            $this->db->delete('blokirktp', ['no_ktp' => $pengguna_no_ktp]);
                            $tanggal_nonaktif = null;
                            $tanggal_aktif = null;
                            $pengguna_status = 1;
                          }
                          $jarak = $tgl1->diff($tgl2);
                          $rentang_ban = $jarak->days;
                          $jarak2 = $tgl2->diff($tgl3);
                          $sisa_ban = $jarak2->days;
                        }
                      ?>
                        <?php if ($i['pengguna_username'] != 'tauhidsaadi') : ?>
                          <tr>
                            <td><img width="40" height="40" class="img-circle" src="<?php echo base_url() . 'assets/images/' . $pengguna_photo; ?>"></td>
                            <td><a href="#" data-toggle="modal" data-target="#ModalEdit<?= $pengguna_id; ?>"><?php echo $pengguna_nama; ?></a></td>
                            <td><?php echo $pengguna_no_ktp; ?></td>
                            <td><a href="<?= base_url('assets/images/' . $pengguna_foto_ktp) ?>"><img src="<?= base_url('assets/images/' . $pengguna_foto_ktp) ?>" class="img-thumbnail" style="width: 200px;"></a></td>
                            <?php if ($pengguna_jenkel == 'L') : ?>
                              <td>Laki-Laki</td>
                            <?php else : ?>
                              <td>Perempuan</td>
                            <?php endif; ?>
                            <!-- <td><?php echo $pengguna_password; ?></td> -->
                            <td><?php echo $pengguna_nohp; ?></td>
                            <?php if ($pengguna_level == '1') : ?>
                              <td>Administrator</td>
                            <?php else : ?>
                              <td>Pengguna</td>
                            <?php endif; ?>
                            <td>
                              <?php if ($pengguna_status == '1') : ?>
                                Aktif
                              <?php elseif ($pengguna_status == '2') : ?>
                                Tidak Aktif
                              <?php elseif ($pengguna_status == '3') : ?>
                                Akun diban sisa <?= $sisa_ban ?> Hari,
                              <?php elseif ($pengguna_status == '4') : ?>
                                Akun diblokir
                              <?php endif; ?>
                            </td>
                            <td style="text-align:right;">
                              <!-- <a class="btn" href="<?php echo base_url() . 'admin/pengguna/reset_password/' . $pengguna_id; ?>" title="Reset Password"><span class="fa fa-refresh"></span></a> -->
                              <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $pengguna_id; ?>"><span class="fa fa-trash"></span></a>
                              <?php if ($pengguna_status == '1' || $pengguna_status == '2') : ?>
                                <a class="btn" data-toggle="modal" data-target="#ModalBlok<?php echo $pengguna_id; ?>" title="Blok/Ban"><span class="fa fa-ban"></span></a>
                              <?php elseif ($pengguna_status == '3' || $pengguna_status == '4') : ?>
                                <a href="<?= base_url('Admin/Pengguna/buka_blok/' . $pengguna_id) ?>" class="btn" title="Buka Blok"><span class="fa fa-unlock"></span></a>
                              <?php endif; ?>

                            </td>
                          </tr>
                        <?php endif ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('/admin/template/footer'); ?>


    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!--Modal Add Pengguna-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url() . 'admin/pengguna/simpan_pengguna' ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
              <div class="col-sm-7">
                <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama Lengkap" required>
              </div>
            </div>
            <div class="form-group">
              <label for="no_ktp" class="col-sm-4 control-label">Nomor KTP</label>
              <div class="col-sm-7">
                <input type="number" name="xno_ktp" class="form-control" id="no_ktp" placeholder="Nomor KTP" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
              <div class="col-sm-7">
                <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                  <label for="inlineRadio1"> Laki-Laki </label>
                </div>
                <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                  <label for="inlineRadio2"> Perempuan </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Username</label>
              <div class="col-sm-7">
                <input type="text" name="xusername" class="form-control" id="inputUserName" placeholder="Username" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
              <div class="col-sm-7">
                <input type="password" name="xpassword" class="form-control" id="inputPassword3" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword4" class="col-sm-4 control-label">Ulangi Password</label>
              <div class="col-sm-7">
                <input type="password" name="xpassword2" class="form-control" id="inputPassword4" placeholder="Ulangi Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Kontak Person</label>
              <div class="col-sm-7">
                <input type="text" name="xkontak" class="form-control" id="inputUserName" placeholder="Kontak Person" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Role</label>
              <div class="col-sm-7">
                <select class="form-control" name="xlevel" required>
                  <option value="1">Administrator</option>
                  <option value="2">Member</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="filefoto" class="col-sm-4 control-label">Foto</label>
              <div class="col-sm-7">
                <input type="file" name="filefoto" class="form-control" required />
              </div>
            </div>
            <div class="form-group">
              <label for="filefoto_ktp" class="col-sm-4 control-label">Foto KTP</label>
              <div class="col-sm-7">
                <input type="file" name="filefoto_ktp" class="form-control" required />
              </div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat btn-sm" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php foreach ($data->result_array() as $i) :
    $pengguna_id = $i['pengguna_id'];
    $pengguna_nama = $i['pengguna_nama'];
    $pengguna_no_ktp = $i['pengguna_no_ktp'];
    $pengguna_foto_ktp = $i['pengguna_foto_ktp'];
    $pengguna_jenkel = $i['pengguna_jenkel'];
    $pengguna_username = $i['pengguna_username'];
    $pengguna_password = $i['pengguna_password'];
    $pengguna_nohp = $i['pengguna_nohp'];
    $pengguna_level = $i['pengguna_level'];
    $pengguna_status = $i['pengguna_status'];
    $pengguna_photo = $i['pengguna_photo'];
    $tanggal_aktif = $i['tanggal_aktif'];
    $tanggal_nonaktif = $i['tanggal_nonaktif'];
  ?>
    <!--Modal Edit Pengguna-->
    <div class="modal fade" id="ModalEdit<?= $pengguna_id; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalEdit<?php echo $pengguna_id; ?>Label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="ModalEdit<?php echo $pengguna_id; ?>Label">Edit Pengguna</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/pengguna/update_pengguna' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-7">
                  <input type="hidden" name="kode" value="<?php echo $pengguna_id; ?>" />
                  <input type="text" name="xnama" class="form-control" id="inputUserName" value="<?php echo $pengguna_nama; ?>" placeholder="Nama Lengkap" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                <div class="col-sm-7">
                  <?php if ($pengguna_jenkel == 'L') : ?>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                      <label for="inlineRadio1"> Laki-Laki </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                      <label for="inlineRadio2"> Perempuan </label>
                    </div>
                  <?php else : ?>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="L" name="xjenkel">
                      <label for="inlineRadio1"> Laki-Laki </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="P" name="xjenkel" checked>
                      <label for="inlineRadio2"> Perempuan </label>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Username</label>
                <div class="col-sm-7">
                  <input type="text" name="xusername" class="form-control" value="<?php echo $pengguna_username; ?>" id="inputUserName" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-7">
                  <input type="password" name="xpassword" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword4" class="col-sm-4 control-label">Ulangi Password</label>
                <div class="col-sm-7">
                  <input type="password" name="xpassword2" class="form-control" id="inputPassword4" placeholder="Ulangi Password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Kontak Person</label>
                <div class="col-sm-7">
                  <input type="text" name="xkontak" class="form-control" value="<?php echo $pengguna_nohp; ?>" id="inputUserName" placeholder="Kontak Person" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Level</label>
                <div class="col-sm-7">
                  <select class="form-control" name="xlevel" required>
                    <?php if ($pengguna_level == '1') : ?>
                      <option value="1" selected>Administrator</option>
                    <?php else : ?>
                      <option value="1">Administrator</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                <div class="col-sm-7">
                  <input type="file" name="filefoto" />
                </div>
              </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat btn-sm" id="simpan">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php foreach ($data->result_array() as $i) :
    $pengguna_id = $i['pengguna_id'];
    $pengguna_nama = $i['pengguna_nama'];
    $pengguna_no_ktp = $i['pengguna_no_ktp'];
    $pengguna_foto_ktp = $i['pengguna_foto_ktp'];
    $pengguna_jenkel = $i['pengguna_jenkel'];
    $pengguna_username = $i['pengguna_username'];
    $pengguna_password = $i['pengguna_password'];
    $pengguna_nohp = $i['pengguna_nohp'];
    $pengguna_level = $i['pengguna_level'];
    $pengguna_status = $i['pengguna_status'];
    $pengguna_photo = $i['pengguna_photo'];
    $tanggal_aktif = $i['tanggal_aktif'];
    $tanggal_nonaktif = $i['tanggal_nonaktif'];
  ?>
    <!--Modal Hapus Pengguna-->
    <div class="modal fade" id="ModalHapus<?php echo $pengguna_id; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalHapus<?php echo $pengguna_id; ?>Label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="ModalHapus<?php echo $pengguna_id; ?>Label">Hapus Pengguna</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/pengguna/hapus_pengguna' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="kode" value="<?php echo $pengguna_id; ?>" />
              <p>Apakah Anda yakin mau menghapus Pengguna <b><?php echo $pengguna_nama; ?></b> ?</p>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--Modal Hapus Pengguna-->
    <div class="modal fade" id="ModalBlok<?php echo $pengguna_id; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalBlok<?php echo $pengguna_id; ?>Label">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="ModalBlok<?php echo $pengguna_id; ?>Label">Blok Pengguna</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'admin/pengguna/Blok_pengguna' ?>" method="post">
            <input type="hidden" name="pengguna_id" value="<?= $pengguna_id ?>">
            <input type="hidden" name="no_ktp" value="<?= $pengguna_no_ktp ?>">
            <div class="modal-body">
              <label class="radio-inline">
                <input type="radio" class="radio_blokir" name="blok" id="radio_blokir" value="4" checked> Blokir
              </label>
              <label class="radio-inline">
                <input type="radio" class="radio_ban" name="blok" id="radio_ban" value="3"> Ban/Nonaktif
              </label>
              <div class="row bulan-minggu" style="margin-top: 10px; padding-left: 15px; display:none;">
                <button type="button" class="btn btn-primary btn-sm minggu">1 Minggu</button>
                <button type="button" class="btn btn-primary btn-sm bulan">1 Bulan</button>
              </div>
              <div class="form-group" style="padding: 15px;">
                <label for="jumlah_hari">Jumlah Hari</label>
                <input type="number" class="form-control jumlah_hari" name="jumlah_hari" id="jumlah_hari" required disabled>
              </div>
              <div class="form-group" style="padding: 15px;">
                <label for="tanggal">s/d Tanggal</label>
                <input type="date" class="form-control tanggal" name="tanggal" id="tanggal" required disabled>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!--Modal Reset Password-->
  <div class="modal fade" id="ModalResetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
        </div>

        <div class="modal-body">

          <table>
            <tr>
              <th style="width:120px;">Username</th>
              <th>:</th>
              <th><?php echo $this->session->flashdata('uname'); ?></th>
            </tr>
            <tr>
              <th style="width:120px;">Password Baru</th>
              <th>:</th>
              <th><?php echo $this->session->flashdata('upass'); ?></th>
            </tr>
          </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <?php $this->load->view('admin/template/notice'); ?>
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
  <!-- page script -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js" integrity="sha512-4WpSQe8XU6Djt8IPJMGD9Xx9KuYsVCEeitZfMhPi8xdYlVA5hzRitm0Nt1g2AZFS136s29Nq4E4NVvouVAVrBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.minggu').on('click', function(e) {
      $('.jumlah_hari').val(7);
      jQuery.ajax({
        url: '<?= base_url('admin/Pengguna/cekTanggal') ?>',
        data: {
          jumlah_hari: 7
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('.tanggal').val(data.tanggal);
        }
      });
    });
    $('.bulan').on('click', function(e) {
      $('.jumlah_hari').val(30);
      jQuery.ajax({
        url: '<?= base_url('admin/Pengguna/cekTanggal') ?>',
        data: {
          jumlah_hari: 30
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('.tanggal').val(data.tanggal);
        }
      });
    });
    $('.radio_blokir').on('click', function(e) {
      $('.jumlah_hari').attr('disabled', 'disabled');
      $('.jumlah_hari').val("");
      $('.tanggal').attr('disabled', 'disabled');
      $('.tanggal').val("");

      $('.bulan-minggu').hide();
    });
    $('.radio_ban').on('click', function(e) {
      $('.jumlah_hari').removeAttr('disabled');
      $('.tanggal').removeAttr('disabled');

      $('.bulan-minggu').show();
    });

    $('.jumlah_hari').on('change', function(e) {
      const jumlah_hari = $(this).val();
      jQuery.ajax({
        url: '<?= base_url('admin/Pengguna/cekTanggal') ?>',
        data: {
          jumlah_hari: jumlah_hari
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('.tanggal').val(data.tanggal);
        }
      });
    });

    $('.tanggal').on('change', function(e) {
      const tanggal = $(this).val();
      jQuery.ajax({
        url: '<?= base_url('admin/Pengguna/cekJumlahHari') ?>',
        data: {
          tanggal: tanggal
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('.jumlah_hari').val(data.jumlah_hari);
        }
      });
    });
  </script>
  <script>
    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
  <?php if ($this->session->flashdata('msg') == 'error') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Error',
        text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
        showHideTransition: 'slide',
        icon: 'error',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#FF4859'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'warning') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Warning',
        text: "Gambar yang Anda masukan terlalu besar.",
        showHideTransition: 'slide',
        icon: 'warning',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#FFC017'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Success',
        text: "Pengguna Berhasil disimpan ke database.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Pengguna berhasil di update",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
    <script type="text/javascript">
      $.toast({
        heading: 'Success',
        text: "Pengguna Berhasil dihapus.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
      });
    </script>
  <?php elseif ($this->session->flashdata('msg') == 'show-modal') : ?>
    <script type="text/javascript">
      $('#ModalResetPassword').modal('show');
    </script>
  <?php else : ?>

  <?php endif; ?>
</body>

</html>