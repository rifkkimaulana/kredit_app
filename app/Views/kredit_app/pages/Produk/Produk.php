<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php foreach ($produkFindAll as $produk) : ?>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a data-toggle="modal" data-target=".bd-example-modal-lg">
                                <div class="card">
                                    <img src="<?= base_url('assets/image/produk') . '/' . $produk['gambar']; ?>" class="card-img-top" alt="Produk <?= $produk['nama_produk']; ?>">
                                    <div class="card-footer">
                                        <h3 class="card-title"><b><?= $produk['nama_produk']; ?></b></h3>
                                        <p class="card-text"><b>Harga : </b> Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                        </div>
                        </a>

                        <!-- Large modal -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="<?= base_url('assets/image/produk') . '/' . $produk['gambar']; ?>" class="card-img-top" alt="Produk <?= $produk['nama_produk']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="post" action="<?= base_url('produk/daftar/sent'); ?>">
                                                            <input type="hidden" name="selectedProduk" value="<?= $produk['id']; ?>">

                                                            <h3 class="card-title"><b><?= $produk['nama_produk']; ?></b></h3>
                                                            <p class="card-text"><b>Harga:</b> Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                                                            <div class="form-group">
                                                                <label for="jumlah_pembelian">Jumlah Pembelian:</label>
                                                                <input type="number" class="form-control" id="jumlahbeli" name="jumlahbeli" placeholder="Masukkan jumlah" value="1">
                                                            </div>
                                                            <hr>
                                                            <div class="float-right">
                                                                <button type="submit" name="add_kredit" class="btn btn-warning btn-sm">
                                                                    <i class="fas fa-credit-card"></i> Paylater
                                                                </button>
                                                                <button type="submit" name="add_keranjang" class=" btn btn-primary btn-sm">
                                                                    <i class="fas fa-shopping-cart"></i> Keranjang
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Deskripsi Produk:</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0"><?= $produk['deskripsi']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                </div>
            </div>
        </div>
</section>

<?= $this->endSection(); ?>