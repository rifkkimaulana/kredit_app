<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <form method="post" action="<?= base_url('penjualan/cekout') ?>">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pembelian</h3>
                            <a class="btn btn-primary float-right" href="<?= base_url('produk/daftar'); ?>">
                                Pilih Produk
                            </a>
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
                                                <a href="<?= base_url('paylater/pendaftaran_kontrak/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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
                                <label for="pembeli">Tenor Pembayaran</label>
                                <select class="form-control select2" name="tenor_Pembayaran">
                                    <?php foreach ($keranjang as $item) : ?>
                                        <option value="1">1 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 1, 0, ',', '.'); ?> / Bulan)</option>
                                        <option value="3">3 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 3, 0, ',', '.'); ?> / Bulan)</option>
                                        <option value="6">6 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 6, 0, ',', '.'); ?> / Bulan)</option>
                                        <option value="9">9 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 9, 0, ',', '.'); ?> / Bulan)</option>
                                        <option value="12">12 Bulan (Rp. <?= number_format($item['harga_satuan'] * $item['jumlah'] / 12, 0, ',', '.'); ?> / Bulan)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <a class="btn btn-primary" data-toggle="modal" data-target="#signature-modal">Open Signature Modal</a>


                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">Selesaikan Transaksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</section>
<!-- /.content -->

<div id="signature-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Signature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('signature_post'); ?>" method="post">

                    <div id="signature-container">
                        <canvas id="signature-pad" width="450" height="300"></canvas>
                    </div>
                    <input type="hidden" name="tanda_tangan" id="tanda_tangan" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="hapus-tanda-tangan">Hapus Tanda Tangan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="save-signature-modal" class="btn btn-primary">Save Signature</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    // Inisialisasi SignaturePad
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    // Hapus tanda tangan jika tombol "Hapus Tanda Tangan" diklik
    document.getElementById('hapus-tanda-tangan').addEventListener('click', function() {
        signaturePad.clear();
    });

    // Simpan tanda tangan sebagai data URL dalam input tersembunyi saat form disubmit
    document.querySelector('form').addEventListener('submit', function() {
        var tandaTanganInput = document.getElementById('tanda_tangan');
        tandaTanganInput.value = signaturePad.toDataURL();
    });
</script>

<?= $this->endSection(); ?>