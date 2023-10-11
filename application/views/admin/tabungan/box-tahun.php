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