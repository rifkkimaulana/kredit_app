<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form role="form" method="post" action="<?= base_url('ka-settings/profile'); ?>" enctype="multipart/form-data">
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

                            <?php if (empty($identitas['status'])) : ?>
                                <button name="update_poto" type="submit" class="btn btn-primary btn-sm float-right">Perbaharui</button>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <input type="hidden" class="form-control" name="user_fotoLama" value="<?= $user['user_foto']; ?>">

                            <div class="form-group text-center">
                                <?php if (!empty($user['user_foto'])) : ?>
                                    <img src="<?= base_url('assets/image/user/' . $user['user_foto']); ?>" alt="Foto Pengguna" style="max-width: 200px;">
                                <?php else : ?>
                                    <img src="<?= base_url('assets/image/user/avatar5.png'); ?>" alt="Avatar Default" style="max-width: 200px;">
                                <?php endif; ?>
                            </div>
                            <?php if (empty($identitas['status'])) : ?>
                                <hr>
                                <div class="form-group">
                                    <label>Pilih Picture Baru</label>
                                    <input type="file" class="form-control" name="user_foto" required>
                                </div>
                            <?php elseif ($identitas['status'] === 'Disetujui') : ?>
                                <hr>
                                <div class="form-group">
                                    <label>Pilih Picture Baru</label>
                                    <input type="file" class="form-control" name="user_foto" required>
                                </div>
                                <button name="update_poto" type="submit" class="btn btn-primary btn-sm float-right">Perbaharui</button>
                            <?php elseif ($identitas['status'] === 'Tidak Disetujui') : ?>
                                <hr>
                                <div class="form-group">
                                    <label>Pilih Picture Baru</label>
                                    <input type="file" class="form-control" name="user_foto" required>
                                </div>
                                <button name="update_poto" type="submit" class="btn btn-primary btn-sm float-right">Perbaharui</button>

                            <?php endif; ?>
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
                            <li class="nav-item"><a class="nav-link" href="#identitasuser<?= $user['user_id'] ?>" data-toggle="tab">Identitas</a></li>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="tab-content ">
                            <!-- Tabs User Detail-->
                            <div class="active tab-pane" id="detailuser<?= $user['user_id'] ?>">
                                <form role="form" method="post" action="<?= base_url('ka-settings/profile'); ?>" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="user_nama" value="<?= $user['user_nama']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="user_username" value="<?= $user['user_username']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. Whatsapp</label>
                                                <input type="text" class="form-control" name="no_wa" value="<?= $user['no_wa']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="<?= $user['email']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country users</label>
                                                <input type="text" class="form-control" name="country" value="<?= $user['country']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Level Users</label>
                                                <input type="text" class="form-control" value="<?= $user['user_level']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea type="text" class="form-control" name="keterangan" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>><?= $user['keterangan']; ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" name="facebook" value="<?= $user['facebook']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Twetter</label>
                                                <input type="text" class="form-control" name="tweeter" value="<?= $user['tweeter']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="text" class="form-control" name="instagram" value="<?= $user['instagram']; ?>" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($identitas['status'] != 'Sedang Ditinjau') : ?>
                                        <hr>
                                        <button name="update_detail" type="submit" class="btn btn-primary float-right">Perbaharui Detail</button>
                                    <?php endif; ?>
                                </form>
                            </div>

                            <!-- Tabs Update Password-->
                            <div class="tab-pane" id="password<?= $user['user_id'] ?>">
                                <form role="form" method="post" action="<?= base_url('ka-settings/profile'); ?>" enctype="multipart/form-data">
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
                                    <hr>
                                    <button name="update_password" type="submit" class="btn btn-primary float-right">Perbaharui Password</button>
                                </form>
                            </div>

                            <!-- Form Identitas -->
                            <div class="tab-pane" id="identitasuser<?= $user['user_id'] ?>">
                                <form method="post" action="<?= base_url('ka-settings/profile'); ?>" enctype="multipart/form-data">
                                    <input name="nama_lengkap" value="<?= $user['user_nama']; ?>" type="hidden">
                                    <div class="form-group">
                                        <label for="nomor_identitas">Nomor Identitas KTP:</label>
                                        <input type="text" class="form-control" id="nomor_identitas" value="<?= $identitas['nomor_identitas']; ?>" name="nomor_identitas" required placeholder="Masukan NIK sesuai ktp" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir:</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan tempat lahir sesuai ktp" value="<?= $identitas['tempat_lahir']; ?>" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir:</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $identitas['tanggal_lahir']; ?>" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?> <?= ($identitas['jenis_kelamin'] === 'Laki-laki') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?> <?= ($identitas['jenis_kelamin'] === 'Perempuan') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat:</label>
                                        <textarea class="form-control" id="alamat" name="alamat" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>><?= $identitas['alamat']; ?></textarea>
                                        <small>Masukan Alamat Lengkap sesuai KTP.</small>

                                        <div class="form-group">
                                            <label for="agama">Agama:</label>
                                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukan agama sesuai ktp" value="<?= $identitas['agama']; ?>" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Pernikahan:</label>
                                            <select class="form-control" id="status_pernikahan" name="status_pernikahan" value="<?= $identitas['status_pernikahan']; ?>" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                                <option value="Belum Menikah" <?= ($identitas['status_pernikahan'] === 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                                                <option value="Menikah" <?= ($identitas['status_pernikahan'] === 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                                                <option value="Cerai" <?= ($identitas['status_pernikahan'] === 'Cerai') ? 'selected' : ''; ?>>Cerai</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan:</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan anda contoh. Wiraswasta" value="<?= $identitas['pekerjaan']; ?>" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                        </div>
                                        <div class="row ml-3">
                                            <div class="cold-md-4">
                                                <div class="form-group">
                                                    <label for="foto_identitas">Foto Identitas:</label>
                                                    <input type="file" class="form-control-file" id="foto_identitas" name="foto_identitas" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                                </div>
                                            </div>
                                            <div class="cold-md-4">
                                                <div class="form-group">
                                                    <label for="foto_selvi_ktp">Foto Selvi KTP:</label>
                                                    <input type="file" class="form-control-file" id="foto_selvi_ktp" name="foto_selvi_ktp" required <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                                </div>
                                            </div>
                                            <div class="cold-md-4">
                                                <div class="form-group">
                                                    <label for="foto_selvi_ktp">Tanda Tangan:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="nomor_alternatif_1">Nama Keluarga:</label>
                                                    <input type="text" class="form-control" id="nama_alternatif_1" value="<?= $identitas['nama_alternatif_1']; ?>" name="nama_alternatif_1" placeholder="Nama Lengkap" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nomor_alternatif_1">Nomor Telpon Keluarga:</label>
                                                    <input type="text" class="form-control" id="nomor_alternatif_1" value="<?= $identitas['nomor_alternatif_1']; ?>" name="nomor_alternatif_1" placeholder="Nomor Telpon" <?= ($identitas['status'] === 'Sedang Ditinjau') ? 'disabled' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (empty($identitas['status'])) : ?>
                                            <hr>
                                            <button name="identitas_insert" type="submit" class="btn btn-primary float-right">Kirim Identitas</button>
                                        <?php elseif ($identitas['status'] === 'Tidak Disetujui') : ?>
                                            <hr>
                                            <input type="hidden" class="form-control" name="foto_identitas_lama" value="<?= $identitas['foto_identitas']; ?>">
                                            <input type="hidden" class="form-control" name="foto_selvi_ktp_lama" value="<?= $identitas['foto_selvi_ktp']; ?>">
                                            <button name="identitas_update" type="submit" class="btn btn-primary float-right">Kirim Ulang Identitas</button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    Gagal Verifikasi. Silahkan kembali perbaiki data anda di tab- identitas.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>