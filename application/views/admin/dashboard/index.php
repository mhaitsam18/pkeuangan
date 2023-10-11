<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>

  <?php $this->load->view('/admin/template/metafile'); ?>

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
          <div class="col-md-12">
            <div class="box">
              <div class="box-body text-center">
                <h2>Selamat Datang di <?php echo APP_NAME; ?></h2>
                <hr>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style="margin-left: 20px;">
              <?php $bulan = date('m'); ?>
              <?php if ($this->session->userdata('level') == '2') : ?>
                <h2>Rekap Data Keuangan Bulan <?= cari_bulan(date('m')) ?></h2>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php if ($this->session->userdata('level') == '1') { ?>
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>
                    <h3><?= $pengguna ?></h3>
                  </h3>
                  <p>Jumlah Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
              </div>
            <?php } ?>
            <?php if ($this->session->userdata('level') == '2') { ?>
              <?php
              $id_admin = $this->session->userdata('idadmin');
              $pem = $this->db->query("SELECT * FROM pemasukan WHERE user_id='$id_admin' AND MONTH(tanggal) = $bulan");
              $pemt = 0;
              $pengt = 0;
              $tabt = 0;
              $hutt = 0;
              foreach ($pem->result() as $as) :;
                $pemh[] = $as->jumlah;
                $pemt = array_sum($pemh);
              endforeach;

              $peng = $this->db->query("SELECT * FROM pengeluaran WHERE user_id='$id_admin' AND MONTH(tanggal) = $bulan");
              foreach ($peng->result() as $ass) :;
                $pengh[] = $ass->jumlah;
                $pengt = array_sum($pengh);
              endforeach;

              $tab = $this->db->query("SELECT * FROM tabungan WHERE user_id='$id_admin' AND MONTH(tanggal) = $bulan");
              foreach ($tab->result() as $row) :;
                $tabh[] = $row->jumlah;
                $tabt = array_sum($tabh);
              endforeach;

              $hut = $this->db->query("SELECT * FROM hutang WHERE user_id='$id_admin' AND level='2' AND MONTH(tanggal) = $bulan");
              foreach ($hut->result() as $rows) :;
                $huth[] = $rows->jumlah;
                $hutt = array_sum($huth);
              endforeach;

              $mb = $pemt - $pengt
              ?>
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>
                    <h3><?php echo convRupiah($pemt); ?></h3>
                  </h3>
                  <p>Jumlah Pemasukan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-plus-circle"></i>
                </div>
              </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <h3><?= convRupiah($pengt) ?></h3>
                </h3>
                <p>Jumlah Pengeluaran</p>
              </div>
              <div class="icon">
                <i class="fa fa-minus-circle"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->

            <div class="small-box bg-teal">
              <div class="inner">
                <h3>
                  <h3><?php echo convRupiah($mb); ?></h3>
                  <p>Dana Yang Tersedia</p>
              </div>
              <div class="icon">
                <i class="fa fa-dollar"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                  <h3>
                    <h3><?= convRupiah($tabt); ?></h3>
                  </h3>

                  <p>Jumlah Tabungan</p>
              </div>
              <div class="icon">
                <i class="fa fa-bank"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>
                  <h3><?= convRupiah($hutt); ?></h3>
                </h3>
                <p>Jumlah Hutang Lunas</p>
              </div>
              <div class="icon">
                <i class="fa fa-money"></i>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>


      </section>
    </div>
    <?php $this->load->view('/admin/template/footer'); ?>

  </div>

  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</body>

</html>