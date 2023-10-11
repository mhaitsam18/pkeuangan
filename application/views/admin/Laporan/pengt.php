<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>

  <?php $this->load->view('/admin/template/metafile'); ?>
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />

</head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('/admin/template/header'); ?>
    <?php $this->load->view('/admin/template/sidebar'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Data Pengeluaran Tahunan</h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="">
              <div class="box">
                <div class="box-body">
                  <table id="example" class="display nowrap" style="width:100%">
                    <?php
                    $peng = $this->db->query("SELECT * FROM pengeluaran WHERE user_id='$id' AND year(tanggal)='$tahun'");
                    $pengt = 0;
                    $r = 0;
                    $rata = 0;
                    foreach ($peng->result() as $ass) :;
                      $pengh[] = $ass->jumlah;
                      $pengt = array_sum($pengh);
                      $r = count($pengh);
                    endforeach;
                    if ($r != 0) {
                      $rata = $pengt / $r;
                    }
                    ?>

                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0;
                      foreach ($laporan as $lap) : $no++; ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?php $j = $lap->jumlah;
                              echo convRupiah($j); ?></td>
                          <td> <?= $lap->keterangan ?></td>
                          <td> <?= $lap->tanggal ?></td>
                        </tr>
                      <?php endforeach; ?>
                      <tr>
                        <td><b>Laporan Tahunan Pengeluaran</b></td>
                        <td>
                          <b>Rata - Rata Pengeluaran = <?= convRupiah($rata) ?></b>
                          <br>
                          <?php foreach ($laporan_bulan as $key => $value) : ?>
                            <b>Rata - Rata Pengeluaran Bulan <?= cari_bulan($key) ?> = <?= convRupiah($value) ?></b>
                            <br>
                          <?php endforeach; ?>
                          <!-- <b>Rata - Rata Pengeluaran Tahunan berdasarkan Bulan = <?= convRupiah($pengt / 12) ?></b> -->
                        </td>
                        <td><b>Total Pengeluaran = <?= convRupiah($pengt) ?></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                        <td><b></b></td>
                      </tr>
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
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'excel', 'pdf', 'print'
        ]
      });
    });
  </script>

  <?php $this->load->view('/admin/template/notice'); ?>

</body>

</html>