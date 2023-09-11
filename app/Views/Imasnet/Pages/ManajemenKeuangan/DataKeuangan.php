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
                            <i class="fas fa-plus"></i> Tambah Data Keuangan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Pengelola</th>
                                        <th class="text-center">Pemasukan</th>
                                        <th class="text-center">Pengeluaran</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Gambar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($keuanganData as $keuangan) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $kategoriMap[$keuangan['kategori_id']]['nama_kategori']; ?></td>
                                            <td class="text-center"><?= $jenisMap[$keuangan['jenis_id']]['nama_jenis']; ?></td>
                                            <td class="text-center"><?= $pengelolaMap[$keuangan['pengelola_id']]['nama_lengkap']; ?></td>
                                            <td class="text-center"><?= $keuangan['pemasukan']; ?></td>
                                            <td class="text-center"><?= $keuangan['pengeluaran']; ?></td>
                                            <td class="text-center"><?= $keuangan['keterangan']; ?></td>
                                            <td class="text-center">
                                                <img src="<?= base_url('assets/image/Imasnet/ManajemenKeuangan/' . $keuangan['foto']); ?>" alt="<?= $keuangan['foto'] ?>" class="img-fluid w-25 h-25">
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $keuangan['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $keuangan['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $keuangan['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $keuangan['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $keuangan['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus keuangan dengan ID: <?= $keuangan['id'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-keuangan/data-keuangan/delete/' . $keuangan['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah -->
                                        <div class="modal fade" id="editModal<?= $keuangan['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $keuangan['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal<?= $keuangan['id'] ?>">Edit Keuangan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('im-manajemen-keuangan/data-keuangan/update'); ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="no_referensi" value="<?= $keuangan['no_referensi']; ?>">
                                                            <input type="hidden" name="id" value="<?= $keuangan['id']; ?>">

                                                            <div class="form-group">
                                                                <label for="kategori_id">Kategori</label>
                                                                <select class="form-control" id="kategori_id" name="kategori_id">
                                                                    <?php foreach ($kategoriKeuanganData as $kategori) : ?>
                                                                        <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $keuangan['kategori_id']) ? 'selected' : ''; ?>>
                                                                            <?= $kategori['nama_kategori']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jenis_id">Jenis</label>
                                                                <select class="form-control" id="jenis_id" name="jenis_id">
                                                                    <?php foreach ($jenisKeuanganData as $jenis) : ?>
                                                                        <option value="<?= $jenis['id']; ?>" <?= ($jenis['id'] == $keuangan['jenis_id']) ? 'selected' : ''; ?>>
                                                                            <?= $jenis['nama_jenis']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pengelola_id">Pengelola</label>
                                                                <select class="form-control" id="pengelola_id" name="pengelola_id">
                                                                    <?php foreach ($pengelolaKeuanganData as $pengelola) : ?>
                                                                        <option value="<?= $pengelola['id']; ?>" <?= ($pengelola['id'] == $keuangan['pengelola_id']) ? 'selected' : ''; ?>>
                                                                            <?= $pengelola['nama_lengkap']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pemasukan">Pemasukan</label>
                                                                <input type="text" class="form-control" id="pemasukan" name="pemasukan" value="<?= $keuangan['pemasukan']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pengeluaran">Pengeluaran</label>
                                                                <input type="text" class="form-control" id="pengeluaran" name="pengeluaran" value="<?= $keuangan['pengeluaran']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $keuangan['keterangan']; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="foto">Foto</label>
                                                                <input type="file" class="form-control-file" id="foto" name="foto">
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
        </div>
    </div>
</section>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-keuangan/data-keuangan/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <?php foreach ($kategoriKeuanganData as $kategori) : ?>
                                <option value="<?= $kategori['id']; ?>"><?= $kategori['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_id">Jenis</label>
                        <select class="form-control" id="jenis_id" name="jenis_id">
                            <?php foreach ($jenisKeuanganData as $jenis) : ?>
                                <option value="<?= $jenis['id']; ?>"><?= $jenis['nama_jenis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengelola_id">Pengelola</label>
                        <select class="form-control" id="pengelola_id" name="pengelola_id">
                            <?php foreach ($pengelolaKeuanganData as $pengelola) : ?>
                                <option value="<?= $pengelola['id']; ?>"><?= $pengelola['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pemasukan">Pemasukan</label>
                        <input type="text" class="form-control" id="pemasukan" name="pemasukan">
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Pengeluaran</label>
                        <input type="text" class="form-control" id="pengeluaran" name="pengeluaran">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
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