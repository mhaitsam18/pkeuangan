<?php $this->load->view('member/template/head'); ?>
<?php $this->load->view('member/template/sidebar'); ?>

<section class="content-header">
    <h1>Histogram Tabungan</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h4>Histogram Mingguan</h4>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="tahun_mingguan" id="tahun_mingguan" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php foreach ($data_tahun as $t) : ?>
                                        <option value="<?= $t->tahun ?>" <?= ($t->tahun == $tahun) ? "selected" : "" ?>><?= $t->tahun ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="bulan_mingguan" id="bulan_mingguan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                        <option value="<?= $i ?>" <?= ($i == $bulan) ? "selected" : "" ?>><?= cari_bulan($i) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="histogram-mingguan">


                        <div class="col-md-8 p-4 ml-3">
                            <canvas id="histogramBulan"></canvas>
                        </div>


                        <script>
                            let ctx = document.getElementById('histogramBulan').getContext('2d');

                            let labels_mingguan = ['Minggu Pertama', 'Minggu kedua', 'Minggu ketiga', 'Minggu keempat', 'Minggu kelima'];
                            let data_mingguan = {
                                labels: labels_mingguan,
                                datasets: [{
                                        label: 'Rata-rata per hari',
                                        data: [
                                            <?php foreach ($avg_tabungan_minggu as $key => $value) {
                                                echo $value . ', ';
                                            } ?>
                                        ],
                                        backgroundColor: 'rgba(255, 99, 132, 1.0)',
                                    },
                                    {
                                        label: 'Total',
                                        data: [
                                            <?php foreach ($sum_tabungan_minggu as $key => $value) {
                                                echo $value . ', ';
                                            } ?>
                                        ],
                                        backgroundColor: 'rgba(54, 162, 235, 1.0)',
                                    },
                                ]
                            };


                            let histogramBulan = new Chart(ctx, {
                                type: 'bar',
                                data: data_mingguan,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Histogram Bulan <?= cari_bulan($bulan) ?> Tahun <?= $tahun ?>'
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h4>Histogram Bulanan</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="tahun_bulanan" id="tahun_bulanan" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php foreach ($data_tahun as $t) : ?>
                                        <option value="<?= $t->tahun ?>" <?= ($t->tahun == $tahun) ? "selected" : "" ?>><?= $t->tahun ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="histogram-bulanan">
                        <div class="col-md-10 p-4 ml-3">
                            <canvas id="histogramTahun"></canvas>
                            <script>
                                let ctz = document.getElementById('histogramTahun').getContext('2d');
                                let labels_bulanan = [
                                    'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember',
                                ];
                                let data_bulanan = {
                                    labels: labels_bulanan,
                                    datasets: [{
                                            label: 'Rata-rata per bulan',
                                            data: [
                                                <?php foreach ($avg_tabungan_bulan as $key => $value) {
                                                    echo $value . ', ';
                                                } ?>
                                            ],
                                            backgroundColor: 'rgba(255, 99, 132, 1.0)',
                                        },
                                        {
                                            label: 'Total',
                                            data: [
                                                <?php foreach ($sum_tabungan_bulan as $key => $value) {
                                                    echo $value . ', ';
                                                } ?>
                                            ],
                                            backgroundColor: 'rgba(54, 162, 235, 1.0)',
                                        },
                                    ]
                                };


                                let histogramTahun = new Chart(ctz, {
                                    type: 'bar',
                                    data: data_bulanan,
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Histogram Tahun <?= $tahun ?>'
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('member/template/script'); ?>
<script>
    $("#bulan_mingguan").on('change', function() {
        const bulan = $(this).val();
        const tahun = $("#tahun_mingguan").val();
        $.ajax({
            url: "<?= base_url('histogram/tabungan_mingguan') ?>",
            type: "post",
            data: {
                'tahun': tahun,
                'bulan': bulan,
            },
            success: function(data) {
                $('#histogram-mingguan').html(data);
            }
        });
    });
    $("#tahun_mingguan").on('change', function() {
        const bulan = $("#bulan_mingguan").val();
        const tahun = $(this).val();
        $.ajax({
            url: "<?= base_url('histogram/tabungan_mingguan') ?>",
            type: "post",
            data: {
                'tahun': tahun,
                'bulan': bulan,
            },
            success: function(data) {
                $('#histogram-mingguan').html(data);
            }
        });
    });
    $("#tahun_bulanan").on('change', function() {
        const tahun = $(this).val();
        $.ajax({
            url: "<?= base_url('histogram/tabungan_bulanan') ?>",
            type: "post",
            data: {
                'tahun': tahun,
            },
            success: function(data) {
                $('#histogram-bulanan').html(data);
            }
        });
    });
</script>

<?php $this->load->view('member/template/footer'); ?>