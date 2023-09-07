<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<?php
if (!empty($_GET['tanggal_awal'])) {
    $tanggalAwal = $_GET['tanggal_awal'];
} else {
    $tanggalAwal = null;
}
if (!empty($_GET['tanggal_akhir'])) {
    $tanggalAkhir = $_GET['tanggal_akhir'];
} else {
    $tanggalAkhir = null;
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('ka-transaksi/laporan/filter'); ?>" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control" <?php if (isset($_GET['tanggal_awal'])) echo 'value="' . $_GET['tanggal_awal'] . '"'; ?>>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control" <?php if (isset($_GET['tanggal_akhir'])) echo 'value="' . $_GET['tanggal_akhir'] . '"'; ?>>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Filter">
                            </div>
                            <div class="form-group">
                                <a href="<?= base_url('ka-transaksi/laporan/cetak') . '?tanggal_awal=' . $tanggalAwal . '&tanggal_akhir=' . $tanggalAkhir; ?>" class="btn btn-success mt-4">Cetak</a>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="padding: 10px;">No. Transaksi</th>
                                <th class="text-center" style="padding: 10px;">Tanggal</th>
                                <th class="text-center" style="padding: 10px;">Jumlah Beli</th>
                                <th class="text-center" style="padding: 10px;">Harga Satuan</th>
                                <th class="text-center" style="padding: 10px;">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($penjualanFindAll as $penjualan) : ?>
                                <tr>
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