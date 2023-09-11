<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Server</th>
                                        <th class="text-center">Voucher</th>
                                        <th class="text-center">Paket</th>
                                        <th class="text-center">Reseller</th>
                                        <th class="text-center">Pengirim</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayatData as $riwayat) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $serverMap[$riwayat['server_id']]['nama_server']; ?></td>
                                            <td class="text-center"><?= $voucherMap[$riwayat['voucher_id']]['code']; ?></td>
                                            <td class="text-center"><?= $paketMap[$riwayat['paket_id']]['nama_paket']; ?></td>
                                            <td class="text-center"><?= $resellerMap[$riwayat['reseller_id']]['nama_lengkap']; ?></td>
                                            <td class="text-center"><?= $pengirimMap[$riwayat['pengirim_id']]['nama_lengkap']; ?></td>
                                            <td class="text-center"><?= $riwayat['keterangan']; ?></td>
                                            <td class="text-center"><?= $riwayat['created_at']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $riwayat['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $riwayat['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $riwayat['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $riwayat['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Riwayat: <?= $riwayat['keterangan'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-voucher/riwayat/delete/' . $riwayat['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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