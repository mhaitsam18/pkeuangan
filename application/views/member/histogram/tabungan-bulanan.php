<div class="col-md-10 p-4 ml-3">
    <canvas id="histogramTahun"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    ctz = document.getElementById('histogramTahun').getContext('2d');

    labels_bulanan = [
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
    data_bulanan = {
        labels: labels_bulanan,
        datasets: [{
                label: 'Rata-rata per minggu',
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

    histogramTahun = new Chart(ctz, {
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