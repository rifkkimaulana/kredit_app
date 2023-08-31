<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('profile'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile Picture</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group text-center">
                                <?php if (!empty($user['user_foto'])) : ?>
                                    <img src="<?= base_url('assets/image/user/' . $user['user_foto']); ?>" alt="Foto Pengguna" style="max-width: 200px;">
                                <?php else : ?>
                                    <img src="<?= base_url('assets/image/user/avatar5.png'); ?>" alt="Avatar Default" style="max-width: 200px;">
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Pilih Picture Baru</label>
                                <input type="file" class="form-control" name="user_foto">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#detailuser<?= $user['user_id'] ?>" data-toggle="tab">Detail User</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password<?= $user['user_id'] ?>" data-toggle="tab">Ubah Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content ">
                                <div class="active tab-pane" id="detailuser<?= $user['user_id'] ?>">
                                    <input type="hidden" class="form-control" name="user_fotoLama" value="<?= $user['user_foto']; ?>">
                                    <input type="hidden" class="form-control" name="user_id" value="<?= $user['user_id']; ?>">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="user_nama" value="<?= $user['user_nama']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="user_username" value="<?= $user['user_username']; ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>No. Whatsapp</label>
                                                <input type="text" class="form-control" name="no_wa" value="<?= $user['no_wa']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $user['email']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country users</label>
                                                <input type="text" class="form-control" name="country" value="<?= $user['country']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Level Users</label>
                                                <input type="text" class="form-control" name="user_level" value="<?= $user['user_level']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea type="text" class="form-control" name="keterangan"> <?= $user['keterangan']; ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" name="facebook" value="<?= $user['facebook']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Twetter</label>
                                                <input type="text" class="form-control" name="tweeter" value="<?= $user['tweeter']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="text" class="form-control" name="instagram" value="<?= $user['instagram']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>