<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-harga {
            text-align: right;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 class="text-center">Laporan Penjualan KREDIT APP</h2>
    <p class="text-center">Tanggal Awal: <?= $tanggalAwal ?> | Tanggal Akhir: <?= $tanggalAkhir ?></p>

    <hr>
    <table>
        <thead>
            <tr>
                <th>No. Transaksi</th>
                <th>Tanggal</th>
                <th>Jumlah Beli</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penjualanFindAll as $penjualan) : ?>
                <tr>
                    <td><?= $penjualan['no_transaksi'] ?></td>
                    <td><?= $penjualan['tanggal_penjualan'] ?></td>
                    <td><?= $penjualan['jumlah'] ?></td>
                    <td><?= 'Rp ' . number_format($penjualan['harga_satuan'], 2) ?></td>
                    <td><?= 'Rp ' . number_format($penjualan['total_harga'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <!-- Tambahkan baris untuk menampilkan total harga -->
        <tfoot>
            <tr>
                <td colspan="4" class="total-harga">Total Harga</td>
                <td class="total-harga"><?= 'Rp ' . number_format($totalHarga, 2) ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>