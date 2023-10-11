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
        <h1>Data Artikel </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">

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
                        <th>Nama Artikel</th>
                        <th>Ulasan & Rating</th>
                        <th>dishare sebanyak</th>
                        <th>Rating</th>
                        <th>Tanggal Dibuat</th>
                        <th>Gambar Artikel</th>
                        <?php if ($this->session->userdata('level') == '1') { ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0;
                      foreach ($items as $item) : $no++; ?>
                        <tr>
                          <td class="text-center"><?php echo $no; ?>.</td>
                          <td>
                            <?php if ($this->session->userdata('level') == '1') { ?>
                              <a href="<?php echo base_url('/admin/artikel/update/' . $item->id); ?>">
                              <?php } ?>
                              <?php echo $item->nama; ?></a>
                          </td>
                          <td><?= $item->count_ulasan ?> kali</td>
                          <td><?= $item->jumlah_share ?> kali</td>
                          <td><i class="fa fa-star" style="color: #FCD93A;"></i><?= number_format($item->avg_rating, 2, ',', '.') ?></td>
                          <td><?php echo $item->tanggal; ?></td>
                          <td><img src="<?= base_url('/assets/images/struktur/' . $item->images); ?>" width="100"></td>
                          <td class="text-center">
                            <a onclick="return confirm('Baca Artikel?');" href="<?php echo site_url('/admin/artikel/liat/' . $item->id); ?>" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-eye"></i></a>
                            <?php if ($this->session->userdata('level') == '1') { ?>
                              <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/artikel/delete/' . $item->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                              <a href="<?php echo site_url('/admin/artikel/gambar/' . $item->id); ?>" class="btn btn-xs btn-info btn-flat"><i class="fa fa-camera"></i></a>
                            <?php } ?>
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