<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>

  <?php $this->load->view('/admin/template/metafile'); ?>
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('/admin/template/header'); ?>
    <?php $this->load->view('/admin/template/sidebar'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Data Pengeluaran <?= $nama_menu ?></h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">
              <?php
              $id_admin = $this->session->userdata('idadmin');
              ?>

              <div class="row">
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-body ">
                      <h4>Tambah Pengeluaran</h4>
                      <form action="<?php echo base_url() . 'admin/pengeluaran/create'; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="rab_id" value="<?= $menu['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $id_admin ?>" id="user_id">
                        <div class="form-group">
                          <label for="jumlah">Jumlah </label>
                          <input type="number" min="1000" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan jumlah pengeluaran" required>
                        </div>
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" cols="30" placeholder="Masukkan keterangan"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= date('d-m-Y'); ?>" required>
                        </div>
                        <?php if ($nama_menu == "tabungan" || $nama_menu == "Tabungan") : ?>
                          <div class="form-group">
                            <label for="">Channel</label>
                            <select class="form-control" id="channel" name="channel" onchange='CheckColors(this.value);' required>
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
                        <?php endif; ?>
                        <input type="hidden" name="nama_rab" value="<?= $nama_menu ?>">
                        <button type="submit" class="btn btn-primary btn-flat btn-sm" href=""><span class="fa fa-save"></span> Simpan</button>
                        <a href="<?= base_url('admin/pengeluaran/') ?>" class="btn btn-success btn-flat btn-sm">Kembali</a>
                      </form>
                      <hr>
                      <!-- <div class="small-box bg-primary">
                        <div class="inner">
                          <?php
                          $pemt = 0;
                          $pengt = 0;
                          $id_admin = $this->session->userdata('idadmin');
                          $pem = $this->db->query("SELECT * FROM pemasukan WHERE user_id='$id_admin'");
                          foreach ($pem->result() as $as) :;
                            $pemh[] = $as->jumlah;
                            $pemt = array_sum($pemh);
                          endforeach;
                          $peng = $this->db->query("SELECT * FROM pengeluaran WHERE user_id='$id_admin'");
                          foreach ($peng->result() as $ass) :;
                            $pengh[] = $ass->jumlah;
                            $pengt = array_sum($pengh);
                          endforeach;
                          ?>
                          <h3>
                            <h3><?php
                                echo convRupiah($pengt);
                                ?></h3>
                          </h3>

                          <p>Jumlah Pengeluaran</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-money"></i>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="box">
              <?php if ($this->session->userdata('level') == '1') { ?>
                <div class="box-header">
                  <a class="btn btn-success btn-flat btn-sm" href="<?php echo base_url('/admin/artikel/create'); ?>"><span class="fa fa-user-plus"></span> Tambah Data</a>
                </div>
              <?php } ?>
              <div class="box-body">
                <table id="datatables" class="table table-striped table-xs table-bordered">
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th>Jumlah</th>
                      <th>Tanggal pengeluaran</th>
                      <th>Keterangan</th>
                      <?php if ($this->session->userdata('level') == '2') { ?>
                        <th>Aksi</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $id_admin = $this->session->userdata('idadmin');
                    $query = $this->db->query("SELECT * FROM pengeluaran WHERE user_id='$id_admin' AND rab_id = " . $menu['id']);
                    $no = 0;
                    foreach ($query->result() as $utama) : $no++;
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $no; ?>.</td>
                        <td>
                          <?php echo convRupiah($utama->jumlah); ?></td>
                        <td><?= $utama->tanggal; ?></td>
                        <td><?php echo $utama->keterangan; ?></td>
                        <td class="text-center">
                          <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/pengeluaran/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                          <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/pengeluaran/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php $this->load->view('/admin/template/footer'); ?>
  </div>
  </div>
  </div>
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>

  <script>
    $(function() {
      $('#datatables').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });
  </script>

  <?php $this->load->view('/admin/template/notice'); ?>

</body>

</html>