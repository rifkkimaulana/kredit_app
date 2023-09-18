<?= $this->extend('Imasnet/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form role="form" method="post" action="<?= base_url('im-settings/profile'); ?>" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title">Profile Picture</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" class="form-control" name="user_fotoLama" value="<?= $user['user_foto']; ?>">
                            <div class="form-group text-center">
                                <?php if (!empty($user['user_foto'])) : ?>
                                    <img src="<?= base_url('assets/image/Imasnet/Settings/Users/' . $user['user_foto']); ?>" alt="Foto Pengguna" style="max-width: 200px;">
                                <?php else : ?>
                                    <img src="<?= base_url('assets/image/user/avatar5.png'); ?>" alt="Avatar Default" style="max-width: 200px;">
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Pilih Picture Baru</label>
                                <input type="file" class="form-control" name="user_foto" required>
                            </div>
                            <button name="update_poto" type="submit" class="btn btn-primary btn-sm float-right">Perbaharui</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#detailuser<?= $user['user_id'] ?>" data-toggle="tab">Detail</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password<?= $user['user_id'] ?>" data-toggle="tab">Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content ">
                            <!-- Tabs User Detail-->
                            <div class="active tab-pane" id="detailuser<?= $user['user_id'] ?>">
                                <form role="form" method="post" action="<?= base_url('im-settings/profile'); ?>">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="user_nama" value="<?= $user['user_nama']; ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="user_username" value="<?= $user['user_username']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. Whatsapp</label>
                                                <input type="text" class="form-control" name="no_wa" value="<?= $user['no_wa']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $user['email']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea type="text" class="form-control" name="keterangan"><?= $user['keterangan']; ?></textarea>
                                    </div>
                                    <hr>
                                    <button name="update_detail" type="submit" class="btn btn-primary float-right">Perbaharui Detail</button>
                                </form>
                            </div>

                            <!-- Tabs Update Password-->
                            <div class="tab-pane" id="password<?= $user['user_id'] ?>">
                                <form role="form" method="post" action="<?= base_url('im-settings/profile'); ?>">
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
                                    <hr>
                                    <button name="update_password" type="submit" class="btn btn-primary float-right">Perbaharui Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>