<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Identitas</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('identitas/update'); ?>" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="identitas_id" value="<?= $identitas['id']; ?>">
                    <input type="hidden" class="form-control" name="user_id" value="<?= $identitas['user_id']; ?>">
                    <input type="hidden" class="form-control" name="foto_identitas_lama" value="<?= $identitas['foto_identitas']; ?>">
                    <input type="hidden" class="form-control" name="foto_selvi_ktp_lama" value="<?= $identitas['foto_selvi_ktp']; ?>">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $identitas['nama_lengkap']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nomor_identitas">Nomor Identitas KTP:</label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" value="<?= $identitas['nomor_identitas']; ?>" required placeholder="Masukan NIK sesuai ktp">
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $identitas['tempat_lahir']; ?>" placeholder="Masukan tempat lahir sesuai ktp" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $identitas['tanggal_lahir']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ml-2">
                                <label>Jenis Kelamin:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" <?= ($identitas['jenis_kelamin'] === 'Laki-laki') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" <?= ($identitas['jenis_kelamin'] === 'Perempuan') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required><?= $identitas['alamat'] ?></textarea>
                        <small>Masukan Alamat Lengkap sesuai KTP.</small>
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama:</label>
                        <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukan agama sesuai ktp" value="<?= $identitas['agama']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Status Pernikahan:</label>
                        <select class="form-control" id="status_pernikahan" name="status_pernikahan" required>
                            <option value="Belum Menikah" <?= ($identitas['status_pernikahan'] === 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                            <option value="Menikah" <?= ($identitas['status_pernikahan'] === 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                            <option value="Cerai" <?= ($identitas['status_pernikahan'] === 'Cerai') ? 'selected' : ''; ?>>Cerai</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan:</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan anda contoh. Wiraswasta" value="<?= $identitas['pekerjaan']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon:</label>
                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Wajib aktif Whatsapp" value="<?= $identitas['nomor_telepon']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Aktif" value="<?= $identitas['email']; ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_identitas">Foto Identitas:</label>
                                        <input type="file" class="form-control-file" id="foto_identitas" name="foto_identitas">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalFotoIdentitas">
                                        Preview
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_selvi_ktp">Foto Selvi KTP:</label>
                                        <input type="file" class="form-control-file" id="foto_selvi_ktp" name="foto_selvi_ktp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalFotoSelvi">
                                        Preview
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nomor_alternatif_1">Nama Alternatif 1:</label>
                                <input type="text" class="form-control" id="nama_alternatif_1" name="nama_alternatif_1" placeholder="Nama Lengkap (opsional)" value="<?= $identitas['nama_alternatif_1']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nomor_alternatif_1">Nomor Alternatif 1:</label>
                                <input type="text" class="form-control" id="nomor_alternatif_2" name="nomor_alternatif_1" placeholder="Nomor Telpon (opsional)" value="<?= $identitas['nomor_alternatif_1']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nomor_alternatif_1">Nama Alternatif 2:</label>
                                <input type="text" class="form-control" id="nama_alternatif_1" name="nama_alternatif_2" placeholder="Nama Lengkap (opsional)" value="<?= $identitas['nama_alternatif_2']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="nomor_alternatif_1">Nomor Alternatif 2:</label>
                                <input type="text" class="form-control" id="nomor_alternatif_2" name="nomor_alternatif_2" placeholder="Nomor Telpon (opsional)" value="<?= $identitas['nomor_alternatif_2']; ?>">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
    </div>
</section>
<!-- Modal Foto Identitas -->
<div class="modal fade" id="modalFotoIdentitas" tabindex="-1" role="dialog" aria-labelledby="modalFotoIdentitasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="<?= base_url('assets/image/identitas/') . '/' . $identitas['foto_identitas']; ?>" class="img-fluid" alt="Foto Identitas">
            </div>
        </div>
    </div>
</div>

<!-- Modal Foto Selvi -->
<div class="modal fade" id="modalFotoSelvi" tabindex="-1" role="dialog" aria-labelledby="modalFotoSelviLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="<?= base_url('assets/image/identitas/') . '/' . $identitas['foto_selvi_ktp']; ?>" class="img-fluid" alt="Foto Selvi KTP">
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>