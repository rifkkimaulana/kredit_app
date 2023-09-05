<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Identitas</h5>
            </div>
            <div class="card-body">
                <form method="post" action="identitas/create" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="user_id" value="<?= $user['user_id']; ?>">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['user_nama']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nomor_identitas">Nomor Identitas KTP:</label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required placeholder="Masukan NIK sesuai ktp">
                    </div>

                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan tempat lahir sesuai ktp" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" required>
                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan">
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        <small>Masukan Alamat Lengkap sesuai KTP.</small>

                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukan agama sesuai ktp" required>
                        </div>

                        <div class="form-group">
                            <label>Status Pernikahan:</label>
                            <select class="form-control" id="status_pernikahan" name="status_pernikahan" required>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai">Cerai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan anda contoh. Wiraswasta" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon:</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Wajib aktif Whatsapp" value="<?= $user['no_wa']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Aktif" value="<?= $user['email']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_identitas">Foto Identitas:</label>
                            <input type="file" class="form-control-file" id="foto_identitas" name="foto_identitas" required>
                        </div>

                        <div class="form-group">
                            <label for="foto_selvi_ktp">Foto Selvi KTP:</label>
                            <input type="file" class="form-control-file" id="foto_selvi_ktp" name="foto_selvi_ktp" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nomor_alternatif_1">Nama Alternatif 1:</label>
                                    <input type="text" class="form-control" id="nomor_alternatif_1" name="nomor_alternatif_1" placeholder="Nama Lengkap (opsional)">
                                </div>
                                <div class="col-md-6">
                                    <label for="nomor_alternatif_1">Nomor Alternatif 1:</label>
                                    <input type="text" class="form-control" id="nomor_alternatif_2" name="nomor_alternatif_1" placeholder="Nomor Telpon (opsional)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nomor_alternatif_1">Nama Alternatif 2:</label>
                                    <input type="text" class="form-control" id="nama_alternatif_1" name="nama_alternatif_2" placeholder="Nama Lengkap (opsional)">
                                </div>

                                <div class="col-md-6">
                                    <label for="nomor_alternatif_1">Nomor Alternatif 2:</label>
                                    <input type="text" class="form-control" id="nama_alternatif_2" name="nama_alternatif_2" placeholder="Nomor Telpon (opsional)">
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

<?= $this->endSection(); ?>