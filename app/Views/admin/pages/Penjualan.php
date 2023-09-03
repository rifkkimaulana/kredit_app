<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>
                <a href="<?= base_url('keranjang'); ?>" type="button" class="btn btn-primary float-right">
                    Tambah Transaksi
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="padding: 10px;">No</th>
                                <th class="text-center" style="padding: 10px;">Tanggal Penjualan</th>
                                <th class="text-center" style="padding: 10px;">Produk</th>
                                <th class="text-center" style="padding: 10px;">Pelanggan</th>
                                <th class="text-center" style="padding: 10px;">Metode Pembayaran</th>
                                <th class="text-center" style="padding: 10px;">Total Harga</th>
                                <th class="text-center" style="padding: 10px;">Status</th>
                                <th class="text-center" style="padding: 10px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penjualanList as $penjualan) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $penjualan['tanggal_penjualan'] ?></td>
                                    <td class="text-center"><?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?></td>
                                    <td class="text-center"><?= $userMap[$penjualan['id_users']]['user_nama'] ?></td>
                                    <td class="text-center"><?= $penjualan['metode_pembayaran'] ?></td>
                                    <td class="text-center"><?= 'Rp.' . number_format($penjualan['total_harga'], 2) ?></td>
                                    <td class="text-center"><?= $penjualan['status'] ?></td>
                                    <td class="text-center">
                                        <?php if ($penjualan['status'] === 'pending') { ?>
                                            <a data-toggle="modal" data-target="#verifikasiModal<?= $penjualan['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Verifikasi
                                            </a><?php } ?>
                                        <a data-toggle="modal" data-target="#detailModal<?= $penjualan['id'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Detail
                                        </a>
                                        <a data-toggle="modal" data-target="#hapusModal<?= $penjualan['id'] ?>" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- End Card Body-->
        </div>
    </div>
</section>
<!-- /.content -->

<?php foreach ($penjualanList as $penjualan) : ?>
    <!-- Detail Modal-->
    <div class="modal fade" id="detailModal<?= $penjualan['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>No. Transaksi:</strong></label>
                        <input type="text" class="form-control" id="namaPelanggan" value="<?= $penjualan['no_transaksi'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="namaPelanggan"><strong>Nama Pelanggan:</strong></label>
                        <input type="text" class="form-control" id="namaPelanggan" value="<?= $userMap[$penjualan['id_users']]['user_nama'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="statusPembelian"><strong>Status Pembelian:</strong></label>
                        <input type="text" class="form-control" id="statusPembelian" value="<?= $penjualan['status'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="tanggalPenjualan"><strong>Tanggal Penjualan:</strong></label>
                        <input type="text" class="form-control" id="tanggalPenjualan" value="<?= $penjualan['tanggal_penjualan'] ?>" disabled>
                    </div>


                    <div class="form-group">
                        <label for="namaProduk"><strong>Nama Produk:</strong></label>
                        <input type="text" class="form-control" value="<?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="namaProduk"><strong>Banyaknya:</strong></label>
                        <input type="text" class="form-control" value="<?= $penjualan['jumlah'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jenisPembayaran"><strong>Jenis Pembayaran:</strong></label>
                        <input type="text" class="form-control" value="<?= $penjualan['metode_pembayaran'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jenisPembayaran"><strong>Status Pembayaran:</strong></label>
                        <input type="text" class="form-control" value="<?= $penjualan['status'] ?>" disabled>
                    </div>
                    <small> Transaksi ini sah dengan nomor referensi: <b><?= $penjualan['no_referensi'] ?></b>.
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
                    <a href="<?= base_url('penjualan/hapus/' . $penjualan['id']) ?>" class="btn btn-danger">Hapus</a>
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
                <form method="post" action="<?= base_url('penjualan/verifikasi') ?>">
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