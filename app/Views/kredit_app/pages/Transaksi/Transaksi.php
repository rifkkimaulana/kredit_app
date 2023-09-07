<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>
                <a href="<?= base_url('ka-transaksi/keranjang'); ?>" type="button" class="btn btn-primary float-right">
                    Tambah Transaksi
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="padding: 10px;">No</th>
                                <th class="text-center" style="padding: 10px;">Tanggal</th>
                                <th class="text-center" style="padding: 10px;">Produk</th>
                                <th class="text-center" style="padding: 10px;">Cust.</th>
                                <th class="text-center" style="padding: 10px;">M. Pembayaran</th>
                                <th class="text-center" style="padding: 10px;">Total Harga</th>
                                <th class="text-center" style="padding: 10px;">Status</th>
                                <th class="text-center" style="padding: 10px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualanFindAll as $penjualan) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $penjualan['tanggal_penjualan'] ?></td>
                                    <td class="text-center"><?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?></td>
                                    <td class="text-center"><?= $userMap[$penjualan['id_users']]['user_nama'] ?></td>
                                    <td class="text-center"><?= $penjualan['metode_pembayaran'] ?></td>
                                    <td class="text-center"><?= 'Rp.' . number_format($penjualan['total_harga'], 2) ?></td>
                                    <td class="text-center"><?= $penjualan['status'] ?></td>
                                    <td class="text-center">
                                        <?php if ($penjualan['metode_pembayaran'] != 'Kredit Paylater') : ?>
                                            <?php if ($user['user_level'] === 'administrator') : ?>
                                                <?php if ($penjualan['status'] === 'pending') { ?>
                                                    <a data-toggle="modal" data-target="#verifikasiModal<?= $penjualan['id'] ?>" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i> Verifikasi
                                                    </a><?php } ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <a data-toggle="modal" data-target="#detailModal<?= $penjualan['id'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <?php if ($user['user_level'] === 'administrator' && $penjualan['metode_pembayaran'] != 'Kredit Paylater') : ?>
                                            <a data-toggle="modal" data-target="#hapusModal<?= $penjualan['id'] ?>" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php foreach ($penjualanFindAll as $penjualan) : ?>
    <!-- Detail Modal-->
    <div class="modal fade" id="detailModal<?= $penjualan['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
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
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Pelanggan:</strong><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Nama</b>
                                    </div>
                                    <div class="col-md-8">
                                        : <?= $userMap[$penjualan['id_users']]['user_nama'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>No WA</b>
                                    </div>
                                    <div class="col-md-8">
                                        : <?= $userMap[$penjualan['id_users']]['no_wa'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>Email</b>
                                    </div>
                                    <div class="col-md-8">
                                        : <?= $userMap[$penjualan['id_users']]['email'] ?>
                                    </div>
                                </div>
                            </address>

                        </div>
                        <div class="col-md-6">
                            <address>
                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>Tanggal</strong>
                                    </div>
                                    <div class="col-md-7">
                                        : <?= $penjualan['tanggal_penjualan'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <strong>No.</strong>
                                    </div>
                                    <div class="col-md-7">
                                        : <?= $penjualan['no_transaksi'] ?>
                                    </div>
                                </div>
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?></td>
                                    <td><?= $penjualan['jumlah'] ?></td>
                                    <td>Rp <?= number_format($penjualan['harga_satuan'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($penjualan['total_harga'], 0, ',', '.') ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Jenis Pembayaran:</strong> <?= $penjualan['metode_pembayaran'] ?></p>
                            <p><strong>Status Pembayaran:</strong> <?= $penjualan['status'] ?></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><strong>Total Tagihan:</strong> Rp <?= number_format($penjualan['total_harga'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <small><strong>Nomor Referensi:</strong> <?= $penjualan['no_referensi'] ?></small>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="print/<?= $penjualan['id'] ?>" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusModal<?= $penjualan['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel<?= $penjualan['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel<?= $penjualan['id'] ?>">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data penjualan <?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('ka-transaksi/transaksi/d/' . $penjualan['id']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifikasiModal<?= $penjualan['id'] ?>" tabindex="-1" aria-labelledby="hapusModalLabel<?= $penjualan['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel<?= $penjualan['id'] ?>">Konfirmasi Penerimaan Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('ka-transaksi/transaksi/verifikasi') ?>">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="penjualan_id" value="<?= $penjualan['id'] ?>">
                        <input type="hidden" class="form-control" name="produk_id" value="<?= $penjualan['id_produk'] ?>">
                        <input type="hidden" class="form-control" name="jumlah_beli" value="<?= $penjualan['jumlah'] ?>">
                        <input type="hidden" class="form-control" name="stok_produk" value="<?= $produkMap[$penjualan['id_produk']]['stok'] ?>">
                        Apakah Anda yakin ingin memverifikasi pembayaran : <b> <?= $penjualan['no_transaksi'] ?> </b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Terima Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>