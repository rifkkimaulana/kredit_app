<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i> Tambah Jenis Keuangan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Jenis Keuangan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($jenisKeuanganData as $jenis) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $kategoriMap[$jenis['kategori_id']]['nama_kategori']; ?></td>
                                            <td class="text-center"><?= $jenis['nama_jenis']; ?></td>
                                            <td class="text-center"><?= $jenis['keterangan']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $jenis['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $jenis['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $jenis['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $jenis['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $jenis['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus keuangan dengan Jenis: <?= $jenis['nama_jenis'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-keuangan/jenis-keuangan/delete/' . $jenis['id']); ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Ubah -->
                                        <div class="modal fade" id="editModal<?= $jenis['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $jenis['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal<?= $jenis['id'] ?>">Edit Jenis Keuangan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('im-manajemen-keuangan/jenis-keuangan/update'); ?>" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $jenis['id']; ?>">
                                                            <div class="form-group">
                                                                <label for="kategori_id">Jenis</label>
                                                                <select class="form-control" id="kategori_id" name="kategori_id">
                                                                    <?php foreach ($kategoriKeuanganData as $kategori) : ?>
                                                                        <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $jenis['kategori_id']) ? 'selected' : ''; ?>>
                                                                            <?= $kategori['nama_kategori']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_jenis">Jenis</label>
                                                                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" value="<?= $jenis['nama_jenis']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $jenis['keterangan']; ?></textarea>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Dalam konteks aplikasi kami, "Jenis Keuangan" merujuk pada klasifikasi lebih rinci dari transaksi keuangan. Sebagai contoh, di bawah kategori "Operasional," Anda dapat memiliki beberapa jenis keuangan seperti biaya gaji staf administrasi, biaya perawatan fasilitas, dan biaya pengadaan bahan baku. Jenis keuangan membantu Anda melacak dan mengelola transaksi keuangan dengan lebih terperinci.
                        </p>
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
                <h5 class="modal-title" id="addModalLabel">Tambah Jenis Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-keuangan/jenis-keuangan/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori_id">Jenis</label>
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <?php foreach ($kategoriKeuanganData as $kategori) : ?>
                                <option value="<?= $kategori['id']; ?>">
                                    <?= $kategori['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_jenis">Jenis</label>
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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