<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <form role="form" method="post" action="<?= base_url('pengaturan/profile_update'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile Picture</h3>
                            <div class="float-right">
                                <?php if ($identitas['status'] === 'Disetujui') : ?>
                                    <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#statusModal">
                                        <i class="fas fa-check"></i> ter-Verifikasi</a>
                                <?php elseif ($identitas['status'] === 'Sedang Ditinjau') : ?>
                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#statusModal">
                                        Sedang Ditinjau</a>
                                <?php elseif ($identitas['status'] === 'Tidak Disetujui') : ?>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#statusModal">
                                        Gagal Verifikasi</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class=" card-body">
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
                                <a class="nav-link" href="<?= base_url('identitas'); ?>">Lengkapi Identitas</a>
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
                                        <textarea type="text" class="form-control" name="keterangan"><?= $user['keterangan']; ?></textarea>
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

<!-- Modal Status Pemeriksaan-->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if ($identitas['status'] === 'Disetujui') : ?>
                    <a class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i> ter-Verifikasi</a>
                <?php elseif ($identitas['status'] === 'Sedang Ditinjau') : ?>
                    <a class="btn btn-warning btn-sm">
                        Sedang Ditinjau</a>
                <?php else : ?>
                    <a class="btn btn-danger btn-sm">
                        Gagal Verifikasi</a>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php if ($identitas['status'] === 'Disetujui') { ?>
                <div class="modal-body">
                    Selamat Anda Berhasil Terverifikasi.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            <?php } elseif ($identitas['status'] === 'Sedang Ditinjau') { ?>
                <div class="modal-body">
                    Permohonan data yang anda kirimkan sedang kami lakukan proses peninjauan biasanya proses peninjauan ini kurang lebih 3x24 Jam sejak formulir dikirimkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            <?php } else { ?>
                <div class="modal-body">
                    Silahkan perbaiki kembali data identitas, jangan sampai ada gambar yang buram atau ada data yang tidak sesuai
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('identitas/update'); ?>" class="btn btn-warning">Perbaiki Data Pengajuan</a>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>