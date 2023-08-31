<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('produk'); ?>" enctype="multipart/form-data">
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
                                                    <a data-toggle="modal" data-target="#detailModal<?= $penjualan['id'] ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat Detail
                                                    </a>
                                                    <a data-toggle="modal" data-target="#editModal<?= $penjualan['id'] ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
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
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

<!-- Modal detail pembelian -->
<?php foreach ($penjualanList as $penjualan) : ?>
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
                    <div class="container">
                        <div class="form-group">
                            <label for="tanggalPenjualan"><strong>Tanggal Penjualan:</strong></label>
                            <input type="text" class="form-control" id="tanggalPenjualan" value="<?= $penjualan['tanggal_penjualan'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="statusPembelian"><strong>Status Pembelian:</strong></label>
                            <input type="text" class="form-control" id="statusPembelian" value="<?= $penjualan['status'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="namaPelanggan"><strong>Nama Pelanggan:</strong></label>
                            <input type="text" class="form-control" id="namaPelanggan" value="<?= $userMap[$penjualan['id_users']]['user_nama'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="namaProduk"><strong>Nama Produk:</strong></label>
                            <input type="text" class="form-control" id="namaProduk" value="<?= $produkMap[$penjualan['id_produk']]['nama_produk'] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="jenisPembayaran"><strong>Jenis Pembayaran:</strong></label>
                            <input type="text" class="form-control" id="jenisPembayaran" value="<?= $penjualan['metode_pembayaran'] ?>" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="print/<?= $penjualan['id'] ?>" target="_blank" class="btn btn-primary">Cetak Invoice</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal<?= $penjualan['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $penjualan['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $penjualan['id'] ?>">Edit Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="proses_edit_penjualan.php" method="post">
                        <input type="hidden" name="penjualan_id" value="<?= $penjualan['id'] ?>">
                        <div class="form-group">
                            <label for="tanggalPenjualan">Tanggal Penjualan:</label>
                            <input type="text" class="form-control" id="tanggalPenjualan" name="tanggal_penjualan" value="<?= $penjualan['tanggal_penjualan'] ?> " disabled>
                        </div>
                        <div class="form-group">
                            <label for="statusPembelian">Status Pembelian:</label>
                            <select class="form-control" id="statusPembelian" name="status_pembelian">
                                <option value="pending" <?= $penjualan['status'] === 'pending' ? ' selected' : '' ?>>Belum Dibayar</option>
                                <option value="Dalam Proses" <?= $penjualan['status'] === 'Dalam Proses' ? ' selected' : '' ?>>Dalam Proses</option>
                                <option value="Selesai" <?= $penjualan['status'] === 'Selesai' ? ' selected' : '' ?>>Selesai</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
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

<?php endforeach; ?>

<?= $this->endSection(); ?>