<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mt-2">Report Payment
                    <?php if (!empty($_GET['tanggal_awal']  || $_GET['tanggal_akhir'])) {
                        echo ' | Filter Date :' .    $_GET['tanggal_awal'] . ' s/d ' . $_GET['tanggal_akhir'];
                    } else {
                        echo '| All Transaction';
                    } ?>
                </h5>
                <div class="float-right">
                    <a href="<?= base_url('ka-transaksi/laporan/excel') . '?tanggal_awal=' . $_GET['tanggal_awal'] . '&tanggal_akhir=' . $_GET['tanggal_akhir']; ?>" class="btn btn-success">
                        <i class="fa fa-file-excel"></i> Export to Excel
                    </a>
                    <a href="<?= base_url('ka-transaksi/laporan/pdf') . '?tanggal_awal=' . $_GET['tanggal_awal'] . '&tanggal_akhir=' . $_GET['tanggal_akhir']; ?>" class="btn btn-danger ">
                        <i class="fa fa-file-pdf"></i> Cetak PDF
                    </a>
                    <a target="_blank" href="<?= base_url('ka-transaksi/laporan/cetak') . '?tanggal_awal=' . $_GET['tanggal_awal'] . '&tanggal_akhir=' . $_GET['tanggal_akhir']; ?>" class="btn btn-primary">
                        <i class="fa fa-print"></i> Cetak
                    </a>
                </div>
            </div>
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="padding: 10px;">No</th>
                                <th class="text-center" style="padding: 10px;">No. Transaksi</th>
                                <th class="text-center" style="padding: 10px;">Tanggal</th>
                                <th class="text-center" style="padding: 10px;">Jumlah Beli</th>
                                <th class="text-center" style="padding: 10px;">Harga Satuan</th>
                                <th class="text-center" style="padding: 10px;">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualanFindAll as $penjualan) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $penjualan['no_transaksi'] ?></td>
                                    <td class="text-center"><?= $penjualan['tanggal_penjualan'] ?></td>
                                    <td class="text-center"><?= $penjualan['jumlah'] ?></td>
                                    <td class="text-center"><?= 'Rp ' . number_format($penjualan['harga_satuan'], 2) ?></td>
                                    <td class="text-center"><?= 'Rp ' . number_format($penjualan['total_harga'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>