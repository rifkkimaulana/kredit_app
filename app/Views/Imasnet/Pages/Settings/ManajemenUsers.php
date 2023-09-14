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
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nama</th>
                                        <th class="text-center" style="padding: 10px;">Username</th>
                                        <th class="text-center" style="padding: 10px;">Email</th>
                                        <th class="text-center" style="padding: 10px;">Posisi</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($userData as $user) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $user['user_nama'] ?></td>
                                            <td><?= $user['user_username'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td class="text-center"><?= $user['user_level'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $user['user_id'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <?php if ($user['user_username'] !== 'admin') : ?>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $user['user_id'] ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pengguna: <?= $user['user_nama'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-settings/users/delete/' . $user['user_id']) ?>" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Edit Users -->
                                        <div class="modal fade" id="editModal<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <ul class="nav nav-pills">
                                                            <li class="nav-item"><a class="nav-link active" href="#profile<?= $user['user_id'] ?>" data-toggle="tab">Profil</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#edit<?= $user['user_id'] ?>" data-toggle="tab">Edit Detail</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#password<?= $user['user_id'] ?>" data-toggle="tab">Ubah Password</a></li>
                                                        </ul>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="users/update" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="tab-content">
                                                                <div class="tab-pane" id="edit<?= $user['user_id'] ?>">
                                                                    <input type="hidden" class="form-control" name="user_id" value="<?= $user['user_id'] ?>">
                                                                    <div class="form-group">
                                                                        <label for="user_nama">Nama</label>
                                                                        <input type="text" class="form-control" name="user_nama" value="<?= $user['user_nama'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="user_username">Username</label>
                                                                        <input type="text" class="form-control" name="user_username" value="<?= $user['user_username'] ?>">
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="no_wa">Whatsapp</label>
                                                                                <input type="text" class="form-control" name="no_wa" value="<?= $user['no_wa'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email">Email</label>
                                                                                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="active tab-pane" id="profile<?= $user['user_id'] ?>">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <?php if (!empty($user['user_foto'])) : ?>
                                                                                <img src="<?= base_url('assets/image/Imasnet/Settings/Users/' . $user['user_foto']) ?>" alt="User Foto" class="img-fluid">
                                                                            <?php else : ?>
                                                                                <img src="<?= base_url('assets/image/user/avatar5.png') ?>" alt="User Default Foto" class="img-fluid">
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="hidden" class="form-control" name="logoLama" value="<?= $user['user_foto'] ?>">
                                                                            <div class="form-group">
                                                                                <label for="user_nama">Picture Profile</label>
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" id="customFile" name="user_foto">
                                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane" id="password<?= $user['user_id'] ?>">
                                                                    <div class="tab-pane" id="password<?= $user['user_id'] ?>">
                                                                        <div class="form-group">
                                                                            <label for="current_password">Username</label>
                                                                            <input type="text" class="form-control" value="<?= $user['user_username'] ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="current_password">Password Saat Ini</label>
                                                                            <input type="password" class="form-control" name="current_password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="new_password">Password Baru</label>
                                                                            <input type="password" class="form-control" name="new_password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="confirm_password">Konfirmasi Password Baru</label>
                                                                            <input type="password" class="form-control" name=" confirm_password">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
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
                <h5 class="modal-title" id="addModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="users/create" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input name="aplication_name" value="imasnet" type="hidden">
                    <div class="form-group">
                        <label for="user_nama">Picture Profile</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="user_foto">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="user_nama" name="user_nama" required>
                    </div>
                    <div class="form-group">
                        <label for="user_username">Username</label>
                        <input type="text" class="form-control" id="user_username" name="user_username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No. Whatsapp</label>
                        <input type="text" class="form-control" id="no_wa" name="no_wa" required>
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