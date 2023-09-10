<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i> Tambah Assets
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Aset</th>
                                        <th class="text-center">Nama Aset</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Penanggung Jawab</th>
                                        <th class="text-center">Latitude</th>
                                        <th class="text-center">Longitude</th>
                                        <th class="text-center">Harga Satuan</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($assetsData as $assets) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $assets['id']; ?></td>
                                            <td class="text-center"><?= $assets['nama_assets']; ?></td>
                                            <td class="text-center"><?= $assets['keterangan']; ?></td>
                                            <td class="text-center"><?= $assets['penanggung_jawab']; ?></td>
                                            <td class="text-center"><?= $assets['latitude']; ?></td>
                                            <td class="text-center"><?= $assets['longitude']; ?></td>
                                            <td class="text-center"><?= $assets['harga_satuan']; ?></td>
                                            <td class="text-center"><?= $assets['jumlah']; ?></td>
                                            <td class="text-center"><?= $assets['satuan']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $assets['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $assets['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $assets['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $assets['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $assets['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Assets : <?= $assets['nama_assets'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-assets/data-aset/delete/' . $assets['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah -->
                                        <div class="modal fade" id="editModal<?= $assets['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $assets['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal<?= $assets['id'] ?>">Edit Pelanggan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('im-manajemen-assets/data-aset/update'); ?>" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $assets['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="kategori_id">Kategori ID</label>
                                                                <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="<?= $assets['kategori_id']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_assets">Nama Aset</label>
                                                                <input type="text" class="form-control" id="nama_assets" name="nama_assets" value="<?= $assets['nama_assets']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $assets['keterangan']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="penanggung_jawab">Penanggung Jawab</label>
                                                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?= $assets['penanggung_jawab']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $assets['latitude']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $assets['longitude']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga_satuan">Harga Satuan</label>
                                                                <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $assets['harga_satuan']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jumlah">Jumlah</label>
                                                                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $assets['jumlah']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="satuan">Satuan</label>
                                                                <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $assets['satuan']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-assets/data-aset/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <?php foreach ($kategoriAssetsData as $kategori) : ?>
                                <option value="<?= $kategori['id']; ?>"><?= $kategori['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_assets">Nama Aset</label>
                        <input type="text" class="form-control" id="nama_assets" name="nama_assets">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude">
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>