<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('users'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manajemen Users</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <tr>
                                            <th class="text-center" style="padding: 10px;"></th>
                                            <th class="text-center" style="padding: 10px;">Nama</th>
                                            <th class="text-center" style="padding: 10px;">Username</th>
                                            <th class="text-center" style="padding: 10px;">Email</th>
                                            <th class="text-center" style="padding: 10px;">Posisi</th>
                                            <th class="text-center" style="padding: 10px;">Aksi</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($allUsers as $user) :
                                            if ($user['user_level'] === 'administrator' && session('user_level') !== 'administrator') {
                                                continue;
                                            }
                                        ?>
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
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->

<?php foreach ($allUsers as $user) :
    if ($user['user_level'] === 'administrator' && session('user_level') !== 'administrator') {
        continue;
    } ?>

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
                    <a href="<?= base_url('users/delete/' . $user['user_id']) ?>" class="btn btn-danger">Hapus</a>
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
                <form method="post" action="<?= base_url('users'); ?>" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label for="user_level">Posisi</label>
                                    <select class="form-control" id="user_level" name="user_level">
                                        <option value="administrator" <?= $user['user_level'] === 'administrator' ? 'selected' : '' ?>>Administrator</option>
                                        <option value="manager" <?= $user['user_level'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                                        <option value="member" <?= $user['user_level'] === 'member' ? 'selected' : '' ?>>Member</option>
                                    </select>
                                </div>

                            </div>
                            <div class="active tab-pane" id="profile<?= $user['user_id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (!empty($user['user_foto'])) : ?>
                                            <img src="<?= base_url('assets/image/user/' . $user['user_foto']) ?>" alt="User Foto" class="img-fluid">
                                        <?php else : ?>
                                            <img src="<?= base_url('assets/image/user/avatar5.png') ?>" alt="User Default Foto" class="img-fluid">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" name="logoLama" value="<?= $user['user_foto'] ?>">
                                        <div class="form-group">
                                            <label for="user_foto">Pilih Foto Baru:</label>
                                            <input type="file" class="form-control" name="user_foto">
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

<?= $this->endSection(); ?>