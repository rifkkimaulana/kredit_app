<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <a class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i>Tambah Suplier Baru
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nama Lengkap</th>
                                        <th class="text-center" style="padding: 10px;">Telpon</th>
                                        <th class="text-center" style="padding: 10px;">No Rek</th>
                                        <th class="text-center" style="padding: 10px;">Nama No Rek</th>
                                        <th class="text-center" style="padding: 10px;">Nama Toko</th>
                                        <th class="text-center" style="padding: 10px;">Alamat</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($suppliers as $suplier) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $suplier['nama_lengkap']; ?></td>
                                            <td><?= $suplier['telpon']; ?></td>
                                            <td><?= $suplier['no_rek']; ?></td>
                                            <td><?= $suplier['nama_no_rek']; ?></td>
                                            <td><?= $suplier['nama_toko']; ?></td>
                                            <td><?= $suplier['alamat']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $suplier['id']; ?>">
                                                    <i class="far fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $suplier['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
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
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('im-inventory/suppliers/create'); ?>" method="POST">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="telpon">Telpon</label>
                        <input type="text" class="form-control" id="telpon" name="telpon" required>
                    </div>
                    <div class="form-group">
                        <label for="no_rek">Nomor Rekening</label>
                        <input type="text" class="form-control" id="no_rek" name="no_rek" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_no_rek">Nama di Rekening</label>
                        <input type="text" class="form-control" id="nama_no_rek" name="nama_no_rek" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>