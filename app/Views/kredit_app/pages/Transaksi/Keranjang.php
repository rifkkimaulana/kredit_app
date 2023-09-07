<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <form method="post" action="<?= base_url('ka-transaksi/transaksi') ?>">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pembelian</h3>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
                                Pilih Produk
                            </button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" class="form-control" name="status" value="pending">
                            <?php if (!empty($keranjang)) : ?>
                                <?php foreach ($keranjang as $item) : ?>
                                    <input type="hidden" class="form-control" name="produk_id[]" value="<?= $item['produk_id'] ?>">
                                    <input type="hidden" class="form-control" name="harga_satuan[]" value="<?= $item['harga_satuan'] ?>">

                                    <div class="row">
                                        <div class="col-md-4 text-center mb-2">
                                            <img src="<?= base_url('assets/image/produk/' . $produk[$item['produk_id']]['gambar']) ?>" alt="<?= $produk[$item['produk_id']]['nama_produk'] ?>" class="img-fluid">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="float-right">
                                                <a href="<?= base_url('ka-transaksi/d/' . $item['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            </div>
                                            <h3><?= $produk[$item['produk_id']]['nama_produk'] ?></h3>
                                            <hr>
                                            <a><b>Harga:</b> Rp. <?= $produk[$item['produk_id']]['harga'] ?></a></br>
                                            <a><b>Jumlah Pembelian:</b> <?= $item['jumlah'] ?> Pcs</a></br>
                                            <a><b>Deskripsi Produk:</b> </a></br>
                                            <a><?= substr($produk[$item['produk_id']]['deskripsi'], 0, 100) . '...' ?> </a>

                                            <input type="hidden" class="form-control" id="jumlah_<?= $item['produk_id'] ?>" name="jumlah[<?= $item['produk_id'] ?>]" value="<?= $item['jumlah']; ?>" min="1">
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Anda belum memilih produk.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan Cekout-->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="pembeli">Customer Name</label>
                                <select class="form-control select2" name="user_id">
                                    <?php if ($user['user_level'] === 'administrator') { ?>
                                        <?php foreach ($userList as $user) : ?>
                                            <?php if ($user['user_level'] === 'member') : ?>
                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_nama'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <option value="<?= $user['user_id'] ?>"><?= $user['user_nama'] ?></option>
                                    <?php }; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="Tunai">Cash</option>
                                    <option value="Transfer">Transfer Bank</option>
                                    <option value="Paylater">Paylater</option>
                                </select>
                            </div>

                            <div id="paylater-details" style="display: none;">
                                <div class="form-group">
                                    <label for="pembeli">Tenor Pembayaran</label>
                                    <select class="form-control select2" name="tenor_pembayaran">
                                        <?php foreach ($keranjang as $item) : ?>
                                            <option value="1">1 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 1, 0, ',', '.'); ?> / Bulan)</option>
                                            <option value="3">3 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 3, 0, ',', '.'); ?> / Bulan)</option>
                                            <option value="6">6 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 6, 0, ',', '.'); ?> / Bulan)</option>
                                            <option value="9">9 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 9, 0, ',', '.'); ?> / Bulan)</option>
                                            <option value="12">12 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 12, 0, ',', '.'); ?> / Bulan)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <hr>
                                <?php if (date("d") < 5) {
                                    $periksaTanggal = date("m") + 1;
                                    $tanggalTagihan = '20' . '/' . $periksaTanggal . '/' . date("Y");
                                } else {
                                    $periksaTanggal = date("m");
                                    $tanggalTagihan = '20' . '/' . $periksaTanggal . '/' . date("Y");
                                } ?>

                                <p> Tanggal Pembayaran Tagihan Pertama : <?= $tanggalTagihan; ?></p>
                            </div>

                            <hr>
                            <div class="card-footer">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="setujukebijakan">
                                    <label class="form-check-label" for="setuju">
                                        Saya telah membaca, memahami, dan menyetujui Syarat dan Ketentuan Penggunaan Layanan Pembiayaan dan Perjanjian Pembiayaan
                                    </label>
                                </div>
                            </div>

                            <div class="float-right mt-3">
                                <button type="submit" class="btn btn-danger">Selesaikan Transaksi</button>
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
            <form method="post" action="<?= base_url('ka-transaksi/keranjang') ?>">
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