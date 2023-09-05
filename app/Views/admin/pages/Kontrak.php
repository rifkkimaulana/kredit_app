<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#pembayaranModal">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">Status</th>
                                        <th class="text-center" style="padding: 10px;">Nomor Kontrak</th>
                                        <th class="text-center" style="padding: 10px;">Nama Lengkap</th>
                                        <th class="text-center" style="padding: 10px;">Total Pembelian</th>
                                        <th class="text-center" style="padding: 10px;">Lunas</th>
                                        <th class="text-center" style="padding: 10px;">Belum Lunas</th>
                                        <th class="text-center" style="padding: 10px;">Tanggal Dibuat</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kontrakList as $kontrak) : ?>
                                        <?php
                                        $Pembayaran = $kontrak['total_kredit'] / $kontrak['jangka_waktu'];

                                        $baruTerbayar = $jumlah_terbayar * $Pembayaran;
                                        $belumLunas = ($kontrak['total_kredit']) - ($baruTerbayar); ?>

                                        <td class="text-center">
                                            <?php if ($belumLunas === 0) { ?>
                                                <a class="btn btn-danger btn-sm">Selesai</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-sm">Active</a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?= $kontrak['no_kontrak'] ?></td>
                                        <td class="text-center"><?= $userMap[$kontrak['user_id']]['user_nama'] ?></td>
                                        <td class="text-center"> Rp. <?= number_format($kontrak['total_kredit'], 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($baruTerbayar, 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($belumLunas, 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= $kontrak['created_at'] ?></td>
                                        <td class="text-center">

                                            <a data-toggle="modal" data-target="#detailPembayaran<?= $kontrak['id'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>