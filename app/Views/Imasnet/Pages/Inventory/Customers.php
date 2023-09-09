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
                            <i class="fas fa-plus"></i> Tambah Pelanggan Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nama Lengkap</th>
                                        <th class="text-center" style="padding: 10px;">Telepon</th>
                                        <th class="text-center" style="padding: 10px;">Alamat</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($customers as $customer) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $customer['nama_lengkap']; ?></td>
                                            <td><?= $customer['telpon']; ?></td>
                                            <td><?= $customer['alamat']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $customer['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $customer['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $customer['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Kategori: <?= $customer['nama_lengkap'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-inventory/customers/delete/' .  $customer['id']); ?>" class="btn btn-primary">Simpan Perubahan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah Customers -->
                                        <div class="modal fade" id="editModal<?= $customer['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Tambah Pelanggan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="customers/update" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $customer['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $customer['nama_lengkap']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="telpon">Nomor Telepon</label>
                                                                <input type="tel" class="form-control" id="telpon" name="telpon" value="<?= $customer['telpon']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat">Alamat</label>
                                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $customer['alamat']; ?> </textarea>
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

<!-- Modal Tambah Customers -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php base_url('im-inventory/customers/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="telpon">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="telpon" name="telpon" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
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