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
                    <?php
                    $i = $utama->persen;
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
                    <?php
                    $total_rab += $p;
                    ?>
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
<script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
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