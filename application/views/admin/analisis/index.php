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
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-body">
                    <div class="rab">
                      <center>
                        <h3>Analisis Pengeluaran & RAB Bulan <?= cari_bulan($bulan) ?> Tahun <?= $tahun ?></h3>
                      </center>
                      <div class="row">
                        <div class="col-md-4">
                          <form action="">
                            <div class="form-group">
                              <select name="bulan" id="bulan" class="form-control">
                                <option value="" selected disabled>Pilih Bulan</option>
                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                  <option value="<?= $i ?>" <?= ($i == $bulan) ? 'selected' : '' ?>><?= cari_bulan($i) ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <h2>RAB</h2>
                          <table class="table table-xs table-bordered">
                            <thead>
                              <tr>
                                <th width="3%">No</th>
                                <th>Pos</th>
                                <th>Persentase</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $id_user = $this->session->userdata('idadmin');
                              $total_rab = 0;
                              $no = 1;
                              foreach ($list_rab->result() as $utama) : ?>
                                <?php $i = $utama->persen;
                                $o = $i / 100;
                                $p = $o * $jumlah_pemasukan;
                                $batas_rab = convRupiah($p);

                                $warna = '';
                                if ($utama->jumlah > $p) {
                                  $warna = 'bg-danger';
                                } elseif ($utama->jumlah < $p) {
                                  $warna = 'bg-success';
                                }
                                ?>
                                <tr class="<?= $warna ?>">
                                  <td class="text-center"><?= $no++; ?>.</td>
                                  <td><?= $utama->nama; ?></td>
                                  <td><?= $utama->persen; ?>%</td>
                                  <td><?= $batas_rab; ?></td>
                                  <td><?= $utama->min; ?>% - <?= $utama->max; ?>%</td>
                                </tr>
                                <?php $total_rab += $p; ?>
                              <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="3" class="text-center">Total RAB</th>
                                <th><?= convRupiah($total_rab) ?></th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <div class="col-lg-6">
                          <h2>Pengeluaran</h2>
                          <table class="table table-xs table-bordered">
                            <thead>
                              <tr>
                                <th width="3%">No</th>
                                <th>Pos</th>
                                <th>Persentase</th>
                                <th>Nilai</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $id_user = $this->session->userdata('idadmin');
                              $totalKeseluruhan = 0;
                              $no = 1;
                              foreach ($list_rab->result() as $utama) : ?>
                                <?php $i = $utama->persen;
                                $o = $i / 100;
                                $p = $o * $jumlah_pemasukan;
                                $batas_rab = convRupiah($p);

                                $warna = '';
                                if ($utama->jumlah > $p) {
                                  $warna = 'bg-danger';
                                } elseif ($utama->jumlah < $p) {
                                  $warna = 'bg-success';
                                }
                                ?>
                                <tr class="<?= $warna ?>">
                                  <td class="text-center"><?= $no++; ?>.</td>
                                  <td><?= $utama->nama; ?></td>
                                  <td>
                                    <?php if ($jumlah_pemasukan != 0) : ?>
                                      <?= number_format($utama->jumlah / $jumlah_pemasukan * 100, 2, ',', '.'); ?>%
                                    <?php else : ?>
                                      Tidak Terdefinisi (Belum ada Pemasukan)
                                    <?php endif; ?>
                                  </td>
                                  <td>Rp.<?= number_format($utama->jumlah, 2, ',', '.'); ?></td>
                                </tr>
                                <?php $totalKeseluruhan += $utama->jumlah; ?>
                              <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="3" class="text-center">Total Pengeluaran</th>
                                <th><?= convRupiah($totalKeseluruhan) ?></th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <h2>Analisis</h2>
                        <table class="table table-xs table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Analisis</th>
                              <th scope="col">Selisih</th>
                              <th scope="col">Keterangan</th>
                            </tr>
                          </thead>
                          <?php if ($total_rab > $totalKeseluruhan) {
                            $hasil = "Pengeluaran < RAB";
                            $selisih = $total_rab - $totalKeseluruhan;
                            $warna = "bg-success";
                            $keterangan = "Kondisi Keuangan Personal Sangat Baik, Pertahankan atau Tingkatkan!";
                          } elseif ($total_rab < $totalKeseluruhan) {
                            $hasil = "Pengeluaran > RAB";
                            $selisih = $totalKeseluruhan - $total_rab;
                            $warna = "bg-danger";
                            $keterangan = "Kondisi Keuangan Personal Sangat Buruk, Benahi manajemen Keuangan Anda!";
                          } else {
                            $hasil = "Pengeluaran = RAB";
                            $selisih = $totalKeseluruhan - $total_rab;
                            $warna = "bg-warning";
                            $keterangan = "Kondisi Keuangan Buruk, pengeluaran dan RAB anda pas-pasan, tingkatkan lagi manajemen Keuangannya";
                          } ?>
                          <tbody>
                            <tr class="<?= $warna ?>">
                              <td><?= $hasil ?></td>
                              <td><?= convRupiah($selisih) ?></td>
                              <td><?= $keterangan ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            $pemt = 0;
            $pengt = 0;
            $tabt = 0;
            $hutt = 0;
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

            $tab = $this->db->query("SELECT * FROM tabungan WHERE user_id='$id_admin'");
            foreach ($tab->result() as $row) :;
              $tabh[] = $row->jumlah;
              $tabt = array_sum($tabh);
            endforeach;

            $hut = $this->db->query("SELECT * FROM hutang WHERE user_id='$id_admin' AND level='1'");
            foreach ($hut->result() as $rows) :;
              $huth[] = $rows->jumlah;
              $hutt = array_sum($huth);
            endforeach;
            $mb = $pemt - $pengt - $hutt - $tabt ?>
            <!-- <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-body">
                    <h3>Analisis Pemasukan :
                      <?php if ($mb < $pemt) : ?>
                        <font color="Black">Pemasukan Anda Cukup</font>
                      <?php elseif ($mb == $pemt) : ?>
                        <font color="green">Ayo Tambahkan Lagi Pemasukan</font>
                      <?php else : ?>
                        <font color="Red">Pemasukan Anda Masih Sangat Kurang</font>
                      <?php endif; ?>
                    </h3>
                    <hr>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-body">
                    <h3>Analisis Pengeluaran :
                      <?php if ($pengt > $pemt) : ?>
                        <font color="Red">Pengeluaran Berlebihan</font>
                      <?php elseif ($pengt == $pemt) : ?>
                        <font color="green">Kurangi Pengeluaran</font>
                      <?php else : ?>
                        <font color="Black">Pengeluaran Anda Masih Aman</font>
                      <?php endif; ?>
                    </h3>
                    <hr>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-body">
                    <h3>Analisis Tabungan :
                      <?php if ($tabt > $pemt) : ?>
                        <font color="Blue">Tabungan Anda Lebih Dari Cukup</font>
                      <?php elseif ($tabt == $pemt) : ?>
                        <font color="green">Tabungan Anda Cukup</font>
                      <?php else : ?>
                        <font color="Red">Tabungan Anda Jauh Dari Cukup</font>
                      <?php endif; ?>
                    </h3>
                    <hr>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-body">
                    <h3>Analisis Hutang :
                      <?php if ($hutt > $pemt) : ?>
                        <font color="Red">Hutang Anda Sudah Berlebihan</font>
                      <?php elseif ($hutt == $pemt) : ?>
                        <font color="green">Kurangi Hutang Anda</font>
                      <?php else : ?>
                        <font color="black">Hutang Anda Masih Aman</font>
                      <?php endif; ?>
                    </h3>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
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

    $("#bulan").on('change', function() {
      var bulan = $(this).val();
      $.ajax({
        url: "<?= base_url('admin/analisis/rab') ?>",
        type: "post",
        data: {
          'bulan': bulan
        },
        success: function(data) {
          $('.rab').html(data);
        }
      });
    });
  </script>

  <?php $this->load->view('/admin/template/notice'); ?>

</body>

</html>