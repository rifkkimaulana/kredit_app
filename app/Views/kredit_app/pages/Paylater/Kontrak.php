<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a href="<?= base_url('ka-transaksi/keranjang'); ?>" class="btn btn-primary float-right">
                            Create New
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">Status</th>
                                        <th class="text-center" style="padding: 10px;">Status Pembayaran</th>
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
                                        <td class="text-center">
                                            <?php if ($kontrak['status'] === 'Sedang Ditinjau') { ?>
                                                <a class="btn btn-warning btn-sm">Ditinjau</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-sm">Disetujui</a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?= $kontrak['no_kontrak'] ?></td>
                                        <td class="text-center"><?= $userMap[$kontrak['user_id']]['user_nama'] ?></td>
                                        <td class="text-center"> Rp. <?= number_format($kontrak['total_kredit'], 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($baruTerbayar, 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($belumLunas, 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= $kontrak['created_at'] ?></td>
                                        <td class="text-center">
                                            <?php if ($kontrak['status'] === 'Sedang Ditinjau') { ?>
                                                <a data-toggle="modal" data-target="#verifikasiModal<?= $kontrak['id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i> Verifikasi
                                                </a>
                                            <?php } ?>
                                            <a data-toggle="modal" data-target="#detailModal<?= $kontrak['id'] ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                        </tr>

                                        <!-- Modal Verifikasi -->
                                        <div class="modal fade" id="verifikasiModal<?= $kontrak['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel<?= $kontrak['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel<?= $kontrak['id'] ?>">Konfirmasi Pembelian Kredit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="<?= base_url('ka-paylater/verifikasi') ?>">
                                                        <div class="modal-body">
                                                            <input type="hidden" class="form-control" name="no_kontrak" value="<?= $kontrak['no_kontrak'] ?>">

                                                            Apakah Anda yakin ingin memverifikasi No Pembelian : <b> <?= $kontrak['no_transaksi'] . '</b> Dengan No Kontrak : <b>' . $kontrak['no_kontrak'] ?> </b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Terima Pembayaran</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Modal-->
                                        <div class="modal fade" id="detailModal<?= $kontrak['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="modal-title" id="detailModalLabel"><b><?= $perusahaan['nama_aplikasi'] ?></b></h5>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>No. Kontrak:</label>
                                                                        <p class="form-control-static"><?= $kontrak['no_kontrak'] ?></p>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Nama User:</label>
                                                                        <p class="form-control-static"><?= $userMap[$kontrak['user_id']]['user_nama'] ?></p>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Total Kredit:</label>
                                                                        <p class="form-control-static">Rp. <?= number_format($kontrak['total_kredit'], 0, ',', '.'); ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Baru Terbayar:</label>
                                                                        <p class="form-control-static">Rp. <?= number_format($baruTerbayar, 0, ',', '.'); ?></p>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Belum Lunas:</label>
                                                                        <p class="form-control-static">Rp. <?= number_format($belumLunas, 0, ',', '.'); ?></p>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Tanggal Pembuatan:</label>
                                                                        <p class="form-control-static"><?= $kontrak['created_at'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
<!-- /.content -->


<?= $this->endSection(); ?>