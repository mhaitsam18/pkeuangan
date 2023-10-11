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
        <h1>Data Hutang </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">

              <div class="row">
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-body ">
                      <div class="small-box bg-red">
                        <div class="inner">
                          <?php
                          $id_admin = $this->session->userdata('idadmin');
                          $query = $this->db->query("SELECT * FROM Hutang WHERE user_id='$id_admin' AND level='1'");
                          $no = 0;
                          $jumlah = [];
                          $total = 0;
                          foreach ($query->result() as $utama) : $no++;
                            $jumlah[] = $utama->jumlah;
                            $total = array_sum($jumlah);
                          ?>
                          <?php endforeach ?>
                          <p>Jumlah Hutang</p>
                          <h3>
                            <h3><?php
                                ?><?php
                                  if ($jumlah == 0) {
                                    echo "Hutang Sudah Lunas";
                                  } else {
                                    echo convRupiah($total);
                                  } ?></h3>
                          </h3>
                        </div>
                        <div class="icon">
                          <i class="fa fa-money"></i>
                        </div>
                      </div>
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
                <a href="<?= base_url('admin/hutang/rincian') ?>" class="btn btn-primary btn-flat btn-sm">Riwayat</a>
                <a class="btn btn-success btn-flat btn-sm" href="<?php echo base_url('/admin/hutang/insert'); ?>"><span class="fa fa-money"></span> Tambah Hutang</a>
                <br> <br>
                <table id="datatables" class="table table-striped table-xs table-bordered">
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th>Tanggal Hutang</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <?php if ($this->session->userdata('level') == '2') { ?>
                        <th>Aksi</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $id_admin = $this->session->userdata('idadmin');
                    $query = $this->db->query("SELECT * FROM Hutang WHERE user_id='$id_admin' AND level='1'");
                    $no = 0;
                    foreach ($query->result() as $utama) : $no++;
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $no; ?>.</td>
                        <td><?= $utama->tanggal; ?></td>
                        <td><?= convRupiah($utama->jumlah); ?></td>
                        <td><?php echo $utama->keterangan; ?></td>
                        <td class="text-center">

                          <a onclick="return confirm('Bayar?');" href="<?php echo site_url('/admin/Hutang/bayar/' . $utama->id); ?>" class="btn btn-xs btn-info btn-flat">Bayar</a>
                          <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/Hutang/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                          <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/Hutang/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
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