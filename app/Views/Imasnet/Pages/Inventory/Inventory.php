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
                                        <th class="text-center" style="padding: 10px;">Foto</th>
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
                                            <td>
                                                <img src="<?= base_url('assets/image/Imasnet/Inventory/' . $inventory['foto']); ?>" alt="Gambar Inventory" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $inventory['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $inventory['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $inventory['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Kategori: <?= $inventory['nama_barang'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-inventory/inventory/delete/' .  $inventory['id']); ?>" class="btn btn-primary">Simpan Perubahan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Ubah Data Inventory Modal -->
                                        <div class="modal fade" id="editModal<?= $inventory['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalInv<?= $inventory['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalInv<?= $inventory['id']; ?>">Tambah Data Inventory</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="inventory/update" method="POST" enctype="multipart/form-data">

                                                            <div id="accordion">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title w-100">
                                                                            <a class="d-block w-100 text-center" data-toggle="collapse" href="#collapseOne">
                                                                                Preview Image
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                                        <div class="form-group">
                                                                            <img src="<?= base_url('assets/image/Imasnet/Inventory/' . $inventory['foto']); ?>" alt="Gambar Inventory" class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="location_id">Lokasi Gudang</label>
                                                                <select class="form-control" id="location_id" name="location_id">
                                                                    <?php foreach ($locations as $location) : ?>
                                                                        <?php $selected = ($location['id'] === $inventory['location_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $location['id']; ?> " <?= $selected; ?>><?= $location['nama_lokasi']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="supliers_id">Pemasok</label>
                                                                <select class="form-control" id="supliers_id" name="supliers_id" required>
                                                                    <?php foreach ($suppliers as $supplier) : ?>
                                                                        <?php $selected = ($supplier['id'] === $inventory['suppliers_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $supplier['id']; ?>" <?= $selected; ?>><?= $supplier['nama_lengkap']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="customers_id">Pelanggan</label>
                                                                <select class="form-control" id="customers_id" name="customers_id" required>
                                                                    <?php foreach ($customers as $customer) : ?>
                                                                        <?php $selected = ($customer['id'] === $inventory['customer_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $customer['id']; ?>" <?= $selected; ?>><?= $customer['nama_lengkap']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="categories_id">Kategori</label>
                                                                <select class="form-control" id="categories_id" name="categories_id">
                                                                    <?php foreach ($categories as $category) : ?>
                                                                        <?php $selected = ($category['id'] === $inventory['categories_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $category['id']; ?>" <?= $selected; ?>><?= $category['nama_kategori']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="nama_barang">Nama Barang</label>
                                                                <input type="text" class="form-control" value="<?= $inventory['nama_barang']; ?>" id="nama_barang" name="nama_barang">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="stok">Stok</label>
                                                                <input type="number" class="form-control" value=" <?= $inventory['stok']; ?>" id="stok" name="stok">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="satuan">Satuan</label>
                                                                <input type="text" class="form-control" value="<?= $inventory['satuan']; ?> " id="satuan" name="satuan">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="harga_satuan">Harga Satuan</label>
                                                                <input type="number" class="form-control" value="<?= $inventory['harga_satuan']; ?>" id="harga_satuan" name="harga_satuan">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $inventory['keterangan']; ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="foto">Foto</label>
                                                                <input type="file" class="form-control-file" id="foto" name="foto" required>
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
                <form action="inventory/create" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="location_id">Lokasi Gudang</label>
                        <select class="form-control" id="location_id" name="location_id">
                            <?php foreach ($locations as $location) : ?>
                                <option value="<?= $location['id']; ?>"><?= $location['nama_lokasi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="supliers_id">Pemasok</label>
                        <select class="form-control" id="supliers_id" name="supliers_id" required>
                            <?php foreach ($suppliers as $suplier) : ?>
                                <option value="<?= $suplier['id']; ?>"><?= $suplier['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="customers_id">Pelanggan</label>
                        <select class="form-control" id="customers_id" name="customers_id" required>
                            <?php foreach ($customers as $customer) : ?>
                                <option value="<?= $customer['id']; ?>"><?= $customer['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categories_id">Kategori</label>
                        <select class="form-control" id="categories_id" name="categories_id">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id']; ?>"><?= $category['nama_kategori']; ?></option>
                            <?php endforeach; ?>
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
                        <input type="file" class="form-control-file" id="foto" name="foto" required>
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