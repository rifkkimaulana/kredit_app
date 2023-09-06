<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
                            Tambah Produk
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nama</th>
                                        <th class="text-center" style="padding: 10px;">Deskripsi</th>
                                        <th class="text-center" style="padding: 10px;">Kategori</th>
                                        <th class="text-center" style="padding: 10px;">Harga</th>
                                        <th class="text-center" style="padding: 10px;">Stok</th>
                                        <th class="text-center" style="padding: 10px;">Gambar</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($products as $product) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $product['nama_produk'] ?></td>
                                            <td><?= substr($product['deskripsi'], 0, 50) ?></td>
                                            <td class="text-center"><?= $product['kategori']['nama_kategori'] ?></td>
                                            <td class="text-center"><?= 'Rp.' . ' ' . $product['harga'] ?></td>
                                            <td class="text-center"><?= $product['stok'] ?></td>
                                            <td class="text-center">
                                                <img src="<?= base_url('assets/image/produk/' . $product['gambar']) ?>" alt="<?= $product['nama_produk'] ?>" style="max-width: 100px;">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $product['id'] ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $product['id'] ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
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
    </div>
</section>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('ka-produk/management_produk') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_id">Kategori Produk</label>
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    <?php foreach ($kategoriProdukFindAll as $kategori) : ?>
                                        <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value="tidak ada keterangan"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="harga" name="harga" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" value="1">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="produk_insert">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($products as $product) : ?>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="deleteModal<?= $product['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Produk: <?= $product['nama_produk'] ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form method="post" action="<?= base_url('ka-produk/management_produk') ?>" enctype="multipart/form-data">
                        <input type="hidden" class="form-control-file" name="produk_id" value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-primary" name="produk_delete">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit Produk -->
    <div class="modal fade" id="editModal<?= $product['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="<?= base_url('ka-produk/management_produk') ?>" enctype="multipart/form-data">
                    <input type="hidden" class="form-control-file" id="produk_id" name="produk_id" value="<?= $product['id'] ?>">
                    <input type="hidden" class="form-control-file" id="gambarLama" name="gambarLama" value="<?= $product['gambar'] ?>">
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <img src="<?= base_url('assets/image/produk/' . $product['gambar']) ?>" alt="<?= $product['nama_produk'] ?>" style="max-width: 200px;">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" class="form-control-file" id="gambar" name="gambar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori_id">Kategori Produk</label>
                                    <select class="form-control" id="kategori_id" name="kategori_id">
                                        <?php foreach ($kategoriProdukFindAll as $kategori) : ?>
                                            <?php $selected = ($kategori['id'] == $product['kategori_id']) ? 'selected' : ''; ?>
                                            <option value="<?= $kategori['id'] ?>" <?= $selected ?>>
                                                <?= $kategori['nama_kategori'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $product['nama_produk'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $product['deskripsi'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $product['harga'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="<?= $product['stok'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="produk_update">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<?= $this->endSection(); ?>