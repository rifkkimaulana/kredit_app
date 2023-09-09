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
                            <i class="fas fa-plus"></i> Tambah Server Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kode Server</th>
                                        <th class="text-center">Nama Server</th>
                                        <th class="text-center">Alamat Server</th>
                                        <th class="text-center">Latitude</th>
                                        <th class="text-center">Longitude</th>
                                        <th class="text-center">Pengelola</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($serverData as $server) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $server['kode_server']; ?></td>
                                            <td class="text-center"><?= $server['nama_server']; ?></td>
                                            <td class="text-center"><?= $server['alamat_server']; ?></td>
                                            <td class="text-center"><?= $server['latitude']; ?></td>
                                            <td class="text-center"><?= $server['longitude']; ?></td>
                                            <td class="text-center"><?= $pengelolaMap[$server['pengelola_id']]['nama_lengkap']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $server['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $server['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $server['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $server['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $server['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Server: <?= $server['nama_server'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-server/server/delete/' .  $server['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah -->
                                        <div class="modal fade" id="editModal<?= $server['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $server['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal<?= $server['id'] ?>">Edit Server</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('im-manajemen-server/server/update'); ?>" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $server['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="kode_server">Kode Server</label>
                                                                <input type="text" class="form-control" id="kode_server" name="kode_server" value="<?= $server['kode_server']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_server">Nama Server</label>
                                                                <input type="text" class="form-control" id="nama_server" name="nama_server" value="<?= $server['nama_server']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat_server">Alamat Server</label>
                                                                <textarea class="form-control" id="alamat_server" name="alamat_server" rows="3" required><?= $server['alamat_server']; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $server['latitude']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $server['longitude']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pengelola_id">Pengelola</label>
                                                                <select class="form-control" id="pengelola_id" name="pengelola_id" required>

                                                                    <?php foreach ($pengelolaData as $pengelola) : ?>
                                                                        <?php $selected = ($pengelola['id'] === $server['pengelola_id']) ? 'selected' : ''; ?>
                                                                        <option value="<?= $pengelola['id']; ?>" <?= $selected; ?>><?= $pengelola['nama_lengkap']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
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
                <h5 class="modal-title" id="addModalLabel">Tambah Server</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-server/server/create'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_server">Nama Server</label>
                        <input type="text" class="form-control" id="nama_server" name="nama_server" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_server">Alamat Server</label>
                        <textarea class="form-control" id="alamat_server" name="alamat_server" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" required>
                    </div>
                    <div class="form-group">
                        <label for="pengelola_id">ID Pengelola</label>
                        <select class="form-control" id="pengelola_id" name="pengelola_id" required>
                            <?php foreach ($pengelolaData as $pengelola) : ?>
                                <option value="<?= $pengelola['id']; ?>"><?= $pengelola['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
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