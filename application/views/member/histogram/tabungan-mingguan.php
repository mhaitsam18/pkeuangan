<div class="col-md-8 p-4 ml-3">
    <canvas id="histogramBulan"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    ctx = document.getElementById('histogramBulan').getContext('2d');

    labels_mingguan = ['Minggu Pertama', 'Minggu kedua', 'Minggu ketiga', 'Minggu keempat', 'Minggu kelima'];
    data_mingguan = {
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


    histogramBulan = new Chart(ctx, {
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