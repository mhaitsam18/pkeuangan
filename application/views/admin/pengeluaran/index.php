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
                <h1>Data Pengeluaran Tahun <?= $tahun ?></h1>
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
                                    <div class="rab">
                                        <center>
                                            <h3>Pengeluaran Bulan <?= cari_bulan($bulan) ?> Tahun <?= $tahun ?></h3>
                                            <h3>
                                                Persentase :
                                                <?php if ($totalPersen == 0) {
                                                    echo "0";
                                                } else {
                                                    echo number_format($totalPersen, 2, ',', '.');
                                                } ?> % <br>
                                            </h3>
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
                                            <div class="col-md-6">
                                                <a href="<?= base_url('Histogram/pengeluaran') ?>" class="btn btn-info">Lihat Histogram</a>
                                            </div>
                                        </div>
                                        <table id="datatables" class="table table-xs table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No</th>
                                                    <th>Pos</th>
                                                    <th>Persentase berdasarkan RAB</th>
                                                    <th>RAB</th>
                                                    <th>Jumlah pengeluaran</th>
                                                    <th>Batas RAB</th>
                                                    <th>Aksi</th>
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
                                                        <td><?= $utama->persen; ?>%</td>
                                                        <td>Rp.<?= number_format($utama->jumlah, 2, ',', '.'); ?></td>
                                                        <td><?= $batas_rab ?></td>
                                                        <td class="text-center">
                                                            <a href="<?php echo site_url('/admin/pengeluaran/page/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php $totalKeseluruhan += $utama->jumlah; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4" class="text-center">Total Pengeluaran</th>
                                                    <th><?= convRupiah($totalKeseluruhan) ?></th>
                                                </tr>
                                            </tfoot>
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
        $(document).ready(function() {
            var isi = $('#persen_total').val();
            console.log(isi);
        });
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script>
        $("#bulan").on('change', function() {
            var bulan = $(this).val();
            $.ajax({
                url: "<?= base_url('admin/pengeluaran/rab') ?>",
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