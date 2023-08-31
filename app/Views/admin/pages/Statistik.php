<!-- Di dalam halaman view -->
<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title ?></h3>
                </div>
                <div class="card-body">
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menambahkan script untuk menggambar grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mendapatkan data yang dikirim dari controller
    var labels = <?= $labels ?>;
    var data = <?= $data ?>;

    // Mendapatkan elemen canvas untuk menggambar grafik
    var ctx = document.getElementById('grafikPenjualan').getContext('2d');

    // Membuat objek grafik menggunakan Chart.js
    var myChart = new Chart(ctx, {
        type: 'line', // Anda bisa mengganti tipe grafik sesuai kebutuhan
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Beli',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang area
                borderWidth: 1
            }]
        },
        options: {
            // Konfigurasi lainnya bisa ditambahkan di sini
        }
    });
</script>
<?= $this->endSection() ?>