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
                            <i class="fas fa-plus"></i> Generate Label
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Server</th>
                                        <th class="text-center">Paket</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Komentar</th>
                                        <th class="text-center">Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($voucherData as $voucher) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $serverMap[$voucher['server_id']]['nama_server']; ?></td>
                                            <td class="text-center"><?= $paketMap[$voucher['paket_id']]['nama_paket']; ?></td>
                                            <td class="text-center"><?= $voucher['code']; ?></td>
                                            <td class="text-center"><?= $voucher['komentar']; ?></td>
                                            <td class="text-center"><?= $voucher['created_at']; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $voucher['id']; ?>">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal<?= $voucher['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $voucher['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $voucher['id'] ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus SN_<?= $voucher['code'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('im-manajemen-voucher/voucher/delete/' . $voucher['id']); ?>" class="btn btn-primary">Hapus</a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Generate Code Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('im-manajemen-voucher/voucher/create'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah">Jumlah Voucher</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="server_id">Server</label>
                        <select class="form-control" id="server_id" name="server_id" required>
                            <?php foreach ($serverData as $server) : ?>
                                <option value="<?= $server['id']; ?>"><?= $server['nama_server']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reseller_id">Reseller</label>
                        <select class="form-control" id="reseller_id" name="reseller_id" required>
                            <?php foreach ($resellerData as $reseller) : ?>
                                <option value="<?= $reseller['id']; ?>"><?= $reseller['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengirim_id">Pengirim</label>
                        <select class="form-control" id="pengirim_id" name="pengirim_id" required>
                            <?php foreach ($pengirimData as $pengirim) : ?>
                                <option value="<?= $pengirim['id']; ?>"><?= $pengirim['nama_lengkap']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paket_id">Paket</label>
                        <select class="form-control" id="paket_id" name="paket_id" required>
                            <?php foreach ($paketData as $paket) : ?>
                                <option value="<?= $paket['id']; ?>"><?= $paket['nama_paket']; ?></option>
                            <?php endforeach; ?>
                        </select>
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