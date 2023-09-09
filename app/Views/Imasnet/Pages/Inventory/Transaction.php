<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i>Tambah Transaksi Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Keterangan</th>
                                        <th class="text-center" style="padding: 10px;">Inventory Name</th>
                                        <th class="text-center" style="padding: 10px;">Biaya</th>
                                        <th class="text-center" style="padding: 10px;">Jumlah Beli</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transactions as $transaction) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $transaction['keterangan']; ?></td>
                                            <td class="text-center">
                                                <?php if (isset($inventoryMap[$transaction['inventory_id']])) : ?>
                                                    <?= $inventoryMap[$transaction['inventory_id']]['nama_barang']; ?>
                                                <?php else : ?>
                                                    Tidak Ditemukan <?= $transaction['inventory_id'] ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?= $transaction['biaya']; ?></td>
                                            <td class="text-center"><?= $transaction['jumlah']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $transaction['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $transaction['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $transaction['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Kategori: <?= $transaction['keterangan'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-inventory/transaction/delete/' .  $transaction['id']); ?>" class="btn btn-primary">Simpan Perubahan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Tambah Transaction -->
                                        <div class="modal fade" id="editModal<?= $transaction['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Ubah Data History Transaksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="transaction/update" method="POST">
                                                            <input type="hidden" name="id" value="<?= $transaction['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control" value="<?= $transaction['keterangan']; ?>" id="keterangan" name="keterangan" value="Pembelian" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="supliers_id">Pemasok</label>
                                                                <select class="form-control" id="supliers_id" name="supliers_id" required>
                                                                    <?php foreach ($suppliers as $supplier) : ?>
                                                                        <?php $selected = ($supplier['id'] === $transaction['supliers_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $supplier['id']; ?>" <?= $selected; ?>><?= $supplier['nama_lengkap']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="customers_id">Pelanggan</label>
                                                                <select class="form-control" id="customers_id" name="customers_id" required>
                                                                    <?php foreach ($customers as $customer) : ?>
                                                                        <?php $selected = ($customer['id'] === $transaction['customers_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $customer['id']; ?>" <?= $selected; ?>><?= $customer['nama_lengkap']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inventory_id">Inventory</label>
                                                                <select class="form-control" id="inventory_id" name="inventory_id" required>
                                                                    <?php foreach ($inventories as $inventory) : ?>
                                                                        <?php $selected = ($inventory['id'] === $transaction['inventory_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $inventory['id']; ?>" <?= $selected; ?>><?= $inventory['nama_barang']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="biaya">Biaya</label>
                                                                <input type="number" class="form-control" value="<?= $transaction['biaya']; ?>" id="biaya" name="biaya" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="jumlah">Jumlah Pembelian</label>
                                                                <input type="number" class="form-control" value="<?= $transaction['jumlah']; ?>" id="jumlah" name="jumlah" required>
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

<!-- Modal Tambah Transaction -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data History Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('im-inventory/transaction/create'); ?>" method="POST">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="Pembelian" required>
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
                        <label for="inventory_id">Inventory</label>
                        <select class="form-control" id="inventory_id" name="inventory_id" required>
                            <?php foreach ($inventories as $inventory) : ?>
                                <option value="<?= $inventory['id']; ?>"><?= $inventory['nama_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="biaya">Biaya</label>
                        <input type="number" class="form-control" id="biaya" name="biaya" required>
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