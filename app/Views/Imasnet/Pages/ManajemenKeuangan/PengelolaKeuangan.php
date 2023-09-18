<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i> Tambah Pengelola
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Lengkap</th>
                                        <th class="text-center">Telpon</th>
                                        <th class="text-center">Saldo</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengelolaKeuanganData as $pengelola) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $userMap[$pengelola['user_id']]['user_nama']; ?></td>
                                            <td class="text-center"><?= $userMap[$pengelola['user_id']]['no_wa']; ?></td>
                                            <td class="text-center"><?= $pengelola['saldo']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $pengelola['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $pengelola['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $pengelola['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $pengelola['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $pengelola['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pengelola keuangan ini: <?= $userMap[$pengelola['user_id']]['user_nama']; ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-keuangan/pengelola-keuangan/delete/' . $pengelola['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah -->
                                        <div class="modal fade" id="editModal<?= $pengelola['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $pengelola['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal<?= $pengelola['id'] ?>">Edit Kategori Keuangan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('im-manajemen-keuangan/pengelola-keuangan/update'); ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $pengelola['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="user_id">User Pengelola</label>
                                                                <select class="form-control" id="user_id" name="user_id">
                                                                    <?php foreach ($usersData as $user) : ?>
                                                                        <option value="<?= $user['user_id']; ?>" <?= ($user['user_id'] == $pengelola['user_id']) ? 'selected' : ''; ?>>
                                                                            <?= $user['user_nama']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="saldo">Saldo</label>
                                                                <input type="text" class="form-control" id="saldo" name="saldo" value="<?= $pengelola['saldo']; ?>">
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Silahkan tambah pengelola baru, pengelola ini terkait dengan manajemen users </p>
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
                <h5 class="modal-title" id="addModalLabel">Tambah Kategori Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-keuangan/pengelola-keuangan/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Pilih Users Menjadi Pengelola</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <?php foreach ($usersData as $user) : ?>
                                <option value="<?= $user['user_id']; ?>">
                                    <?= $user['user_nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="saldo">Saldo</label>
                        <input type="text" class="form-control" id="saldo" name="saldo" value="0">
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