<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
                            Tambah Transaksi
                        </button>
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

                                        <!-- Detail Modal-->
                                        <div class="modal fade" id="detailModal<?= $penjualan['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
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
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="statusPembelian"><strong>Status Pembelian:</strong></label>
                                                                    <input type="text" class="form-control" id="statusPembelian" value="<?= $penjualan['status'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="tanggalPenjualan"><strong>Tanggal Penjualan:</strong></label>
                                                                    <input type="text" class="form-control" id="tanggalPenjualan" value="<?= $penjualan['tanggal_penjualan'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="namaProduk"><strong>Nama Produk:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="namaProduk"><strong>Banyaknya:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $penjualan['jumlah'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jenisPembayaran"><strong>Jenis Pembayaran:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $penjualan['metode_pembayaran'] ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jenisPembayaran"><strong>Status Pembayaran:</strong></label>
                                                                    <input type="text" class="form-control" value="<?= $penjualan['status'] ?>" disabled>
                                                                </div>
                                                            </div>
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

<!-- Modal Tambah Penjualan -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('keranjang') ?>">
                <div class="modal-body">
                    <table id="tableAddPenjualan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Pilih</th>
                                <th>Nama Produk</th>
                                <th class="text-center">Jumlah Beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $produk) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="selectedProduk[]" value="<?= $produk['id'] ?>" id="checkbox_<?= $produk['id'] ?>">
                                                <label for="checkbox_<?= $produk['id'] ?>"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" d-flex align-items-center">
                                            <img src="<?= base_url('assets/image/produk/' . $produk['gambar']) ?>" alt="<?= $produk['nama_produk'] ?>" class="mr-3" style="max-width: 50px;">
                                            <?= $produk['nama_produk'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="jumlahbeli[<?= $produk['id'] ?>]" value="1" min="1">
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Pilih Produk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>