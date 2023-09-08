<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addInventoryModal">
                            <i class="fas fa-plus"></i> Tambah Inventory Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nama Barang</th>
                                        <th class="text-center" style="padding: 10px;">Stok</th>
                                        <th class="text-center" style="padding: 10px;">Satuan</th>
                                        <th class="text-center" style="padding: 10px;">Harga Satuan</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($inventories as $inventory) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $inventory['nama_barang']; ?></td>
                                            <td><?= $inventory['stok']; ?></td>
                                            <td><?= $inventory['satuan']; ?></td>
                                            <td><?= $inventory['harga_satuan']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $inventory['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $inventory['id']; ?>">
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

<!-- Tambah Data Inventory Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInventoryModalLabel">Tambah Data Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('im-inventory/inventory/create'); ?>" method="POST">
                    <div class="form-group">
                        <label for="location_id">Lokasi</label>
                        <select class="form-control" id="location_id" name="location_id">
                            <!-- Option untuk Lokasi -->
                            <option value="1">Lokasi 1</option>
                            <option value="2">Lokasi 2</option>
                            <!-- Tambahkan option sesuai dengan data yang Anda miliki -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="suppliers_id">Pemasok</label>
                        <select class="form-control" id="suppliers_id" name="suppliers_id">
                            <!-- Option untuk Pemasok -->
                            <option value="1">Pemasok 1</option>
                            <option value="2">Pemasok 2</option>
                            <!-- Tambahkan option sesuai dengan data yang Anda miliki -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Pelanggan</label>
                        <select class="form-control" id="customer_id" name="customer_id">
                            <!-- Option untuk Pelanggan -->
                            <option value="1">Pelanggan 1</option>
                            <option value="2">Pelanggan 2</option>
                            <!-- Tambahkan option sesuai dengan data yang Anda miliki -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categories_id">Kategori</label>
                        <select class="form-control" id="categories_id" name="categories_id">
                            <!-- Option untuk Kategori -->
                            <option value="1">Kategori 1</option>
                            <option value="2">Kategori 2</option>
                            <!-- Tambahkan option sesuai dengan data yang Anda miliki -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan">
                    </div>

                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input type="number" class="form-control" id="harga_satuan" name="harga_satuan">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>