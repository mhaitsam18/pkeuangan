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
        <h1>Data Tabungan </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">

              <div class="row">
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-header">
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group">
                            <select name="tahun" id="tahun" class="form-control">
                              <option value="">Pilih Tahun</option>
                              <?php foreach ($data_tahun as $t) : ?>
                                <option value="<?= $t->tahun ?>"><?= $t->tahun ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-8">
                          <a href="<?= base_url('histogram/tabungan') ?>" class="btn btn-info">Lihat Histogram</a>
                        </div>
                      </div>
                    </div>
                    <div class="box-body" id="box-tahun">
                      <h3>
                        Jumlah Tabungan Tahun <?= $tahun ?>
                      </h3>
                      <?php
                      $bulan = [];
                      for ($i = 1; $i <= 12; $i++) {
                        $bulan[$i] = cari_bulan($i);
                      }
                      ?>
                      <?php foreach ($bulan as $key => $nilai) : ?>
                        <?php
                        $total = 0;
                        $id_admin = $this->session->userdata('idadmin');
                        $query = $this->db->query("SELECT * FROM tabungan WHERE user_id='$id_admin' AND MONTH(tanggal) = $key AND YEAR(tanggal) = $tahun");
                        $no = 0;
                        $jumlah = [];
                        foreach ($query->result() as $utama) {
                          $no++;
                          $jumlah[] = $utama->jumlah;
                          $total = array_sum($jumlah);
                        }
                        ?>
                        <div class="col-md-3">
                          <div class="small-box bg-primary">
                            <div class="inner">
                              <h3>
                                <h3><?= convRupiah($total); ?></h3>
                              </h3>
                              <p><?= $nilai ?></p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-money"></i>
                            </div>
                          </div>

                        </div>
                      <?php endforeach; ?>
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
                <a href="<?= base_url('admin/tabungan/create') ?>" class="btn btn-sm btn-success ">Tambah Data</a><br><br>
                <div id="table-tahun">
                  <table id="datatables" class="table table-striped table-xs table-bordered">
                    <thead>
                      <tr>
                        <th width="3%">No</th>
                        <th>Tanggal tabungan</th>
                        <th>Keterangan</th>
                        <th>Uang Tersimpan</th>
                        <th>Channel</th>
                        <th>Jumlah</th>
                        <?php if ($this->session->userdata('level') == '2') { ?>
                          <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $id_admin = $this->session->userdata('idadmin');
                      $query = $this->db->query("SELECT * FROM tabungan WHERE user_id='$id_admin'");
                      $no = 0;
                      foreach ($query->result() as $utama) : $no++;
                      ?>
                        <tr>
                          <td class="text-center"><?php echo $no; ?>.</td>
                          <td><?= $utama->tanggal; ?></td>
                          <td><?php echo $utama->keterangan; ?></td>
                          <td><?php echo $utama->penyimpanan; ?></td>
                          <td><?php echo $utama->channel; ?></td>
                          <td>
                            <?php echo convRupiah($utama->jumlah); ?>
                          </td>
                          <td class="text-center">
                            <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/tabungan/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                            <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/tabungan/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
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
    $("#tahun").on("change", function() {
      const tahun = $(this).val();
      $.ajax({
        url: "<?= base_url('admin/tabungan/box') ?>",
        type: "post",
        data: {
          'tahun': tahun,
        },
        success: function(data) {
          $('#box-tahun').html(data);
        }
      });
      $.ajax({
        url: "<?= base_url('admin/tabungan/table') ?>",
        type: "post",
        data: {
          'tahun': tahun,
        },
        success: function(data) {
          $('#table-tahun').html(data);
        }
      });
    });

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