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
                            <i class="fas fa-plus"></i> Tambah Catatan History Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Keterangan</th>
                                        <th class="text-center" style="padding: 10px;">Jenis</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($history as $item) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $item['keterangan']; ?></td>
                                            <td><?= $item['jenis']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $item['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $item['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Kategori: <?= $item['keterangan'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-inventory/history/delete/' .  $item['id']); ?>" class="btn btn-primary">Simpan Perubahan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Tambah Histori -->
                                        <div class="modal fade" id="editModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Tambah Data History</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="history/update" method="POST">
                                                            <input type="hidden" value="<?= $item['id']; ?>" name="id">
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $item['keterangan']; ?>" placeholder="Masukkan keterangan" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="jenis">Jenis</label>
                                                                <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $item['jenis']; ?>" placeholder="Masukkan jenis" required>
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

<!-- Modal Tambah Histori -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('im-inventory/history/create'); ?>" method="POST">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis" required>
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