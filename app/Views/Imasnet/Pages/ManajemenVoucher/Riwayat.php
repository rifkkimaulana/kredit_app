<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" href="<?= base_url('im-manajemen-voucher/voucher/myqr'); ?>">
                            <i class="fas fa-plus"></i> Tambah Transaksi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Server</th>
                                        <th class="text-center">Paket</th>
                                        <th class="text-center">Reseller</th>
                                        <th class="text-center">Pengirim</th>
                                        <th class="text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayatData as $riwayat) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $serverMap[$riwayat['server_id']]['nama_server']; ?></td>
                                            <td class="text-center"><?= $paketMap[$riwayat['paket_id']]['nama_paket']; ?></td>
                                            <td class="text-center"><?= $resellerMap[$riwayat['reseller_id']]['nama_lengkap']; ?></td>
                                            <td class="text-center"><?= $pengirimMap[$riwayat['pengirim_id']]['nama_lengkap']; ?></td>

                                            <td class="text-center"><?= $riwayat['created_at']; ?></td>

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




<?= $this->endSection(); ?>