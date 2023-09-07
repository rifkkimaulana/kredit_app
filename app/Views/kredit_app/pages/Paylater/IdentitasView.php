<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Status</th>
                                        <th class="text-center" style="padding: 10px;">Nama Lengkap</th>
                                        <th class="text-center" style="padding: 10px;">Alamat</th>
                                        <th class="text-center" style="padding: 10px;">Tanggal Pengajuan</th>
                                        <?php if ($user['user_level'] === 'administrator') : ?>
                                            <th class="text-center" style="padding: 10px;">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($identitasList as $identitas) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center">
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
                                            </td>
                                            <td class="text-center"><?= $identitas['nama_lengkap'] ?></td>
                                            <td class="text-center"><?= $identitas['alamat'] ?></td>
                                            <td class="text-center"><?= $identitas['created_at'] ?></td>
                                            <?php if ($user['user_level'] === 'administrator') : ?>
                                                <td class="text-center">
                                                    <a data-toggle="modal" data-target="#detailModal<?= $identitas['id'] ?>" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $identitas['id'] ?>">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                    </a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $identitas['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus Identitas Form: <?= $identitas['nama_lengkap'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-danger" href="<?= base_url('ka-paylater/identitas/delete') . '/' . $identitas['id'] ?>">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Detail -->
                                        <div class="modal fade bd-example-modal-lg" id="detailModal<?= $identitas['id'] ?>" tabindex="-1" aria-labelledby="detailLabel<?= $identitas['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailLabel<?= $identitas['id'] ?>">Detail Identitas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="card-title">Foto KTP</div>
                                                                    </div>
                                                                    <img src="<?= base_url('assets/image/identitas/') . '/' . $identitas['foto_identitas']; ?>" class="img-fluid" alt="Foto Identitas">
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="card-title">Foto Selvi KTP</div>
                                                                    </div>
                                                                    <img src="<?= base_url('assets/image/identitas/') . '/' . $identitas['foto_selvi_ktp']; ?>" class="img-fluid" alt="Foto Selvi KTP">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                                                    <input type="text" class="form-control" value="<?= $identitas['nama_lengkap']; ?>" disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="nomor_identitas">Nomor Identitas KTP:</label>
                                                                    <input type="text" class="form-control" value="<?= $identitas['nomor_identitas']; ?>" disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="tempat_lahir">Tempat Lahir:</label>
                                                                    <input type="text" class="form-control" value="<?= $identitas['tempat_lahir']; ?>" disabled>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                                                                            <input type="date" class="form-control" value="<?= $identitas['tanggal_lahir']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group ml-2">
                                                                            <label>Jenis Kelamin:</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" value="Laki-laki" <?= ($identitas['jenis_kelamin'] === 'Laki-laki') ? 'checked' : ''; ?> disabled>
                                                                                <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" value="Perempuan" <?= ($identitas['jenis_kelamin'] === 'Perempuan') ? 'checked' : ''; ?> disabled>
                                                                                <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat:</label>
                                                                    <textarea class="form-control" disabled><?= $identitas['alamat'] ?></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="agama">Agama:</label>
                                                                    <input type="text" class="form-control" value="<?= $identitas['agama']; ?>" disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Status Pernikahan:</label>
                                                                    <select class="form-control" disabled>
                                                                        <option value="Belum Menikah" <?= ($identitas['status_pernikahan'] === 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                                                                        <option value="Menikah" <?= ($identitas['status_pernikahan'] === 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                                                                        <option value="Cerai" <?= ($identitas['status_pernikahan'] === 'Cerai') ? 'selected' : ''; ?>>Cerai</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="pekerjaan">Pekerjaan:</label>
                                                                    <input type="text" class="form-control" value="<?= $identitas['pekerjaan']; ?>" disabled>
                                                                </div>

                                                                <hr>

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="nomor_alternatif_1">Nama Alternatif 1:</label>
                                                                            <input type="text" class="form-control" value="<?= $identitas['nama_alternatif_1']; ?>" disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="nomor_alternatif_1">Nomor Alternatif 1:</label>
                                                                            <input type="text" class="form-control" value="<?= $identitas['nomor_alternatif_1']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <?php if ($identitas['status'] === 'Disetujui') { ?>
                                                                <a href="<?= base_url('ka-paylater/identitas/tolak/' . $identitas['id']) ?>" class="btn btn-danger">Batal Setuju</a>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url('ka-paylater/identitas/tolak/' . $identitas['id']) ?>" class="btn btn-danger">Data Tidak Sesuai</a>
                                                                <a href="<?= base_url('ka-paylater/identitas/terima/' . $identitas['id']) ?>" class="btn btn-success">Setujui</a>
                                                            <?php } ?>
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

<?= $this->endSection(); ?>