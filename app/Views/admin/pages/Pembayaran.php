<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#pembayaranModal">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">No</th>
                                        <th class="text-center" style="padding: 10px;">Nomor Kontrak</th>
                                        <th class="text-center" style="padding: 10px;">Jumlah Pembayaran</th>
                                        <th class="text-center" style="padding: 10px;">Jenis Pembayaran</th>
                                        <th class="text-center" style="padding: 10px;">No. Referensi</th>
                                        <th class="text-center" style="padding: 10px;">Status Pembayaran</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pembayaran as $pembayaran) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $pembayaran['no_kontrak'] ?></td>
                                            <td class="text-center"><?= $pembayaran['jumlah_pembayaran'] ?></td>
                                            <td class="text-center"><?= $pembayaran['jenis_pembayaran'] ?></td>
                                            <td class="text-center"><?= $pembayaran['no_referensi'] ?></td>
                                            <td class="text-center"><?= $pembayaran['status'] ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#detailPembayaran<?= $pembayaran['id'] ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
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
<!-- /.content -->


<!-- Modal Pembayaran Tagihan -->
<div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('pembayaran/tambah') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="user_id" value="<?= $user_id; ?>">
                    <input type="hidden" class="form-control" name="kredit_id" value="<?= $kredit_id; ?>">
                    <input type="hidden" class="form-control" name="status" value="Menunggu Konfirmasi">
                    <div class="form-group">
                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                        <select class="form-control" name="jenis_pembayaran">
                            <option value="Tunai">Pembayaran Tunai</option>
                            <option value="Transfer">Pembayaran Transfer Bank</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Nomor Kontrak</label>
                        <select class="form-control" name="no_kontrak">
                            <?php foreach ($kontrakList as $kredit) : ?>
                                <option value="<?= $kredit['no_kontrak']; ?>"><?= $kredit['no_kontrak']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <small>Silahkan pilih nomor kontrak sebelum melakukan konfirmasi pembayaran</small>
                    </div>
                    <div class="form-group">
                        <label for="harga">Jumlah Bayar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="jumlah_bayar" value="<?= $total_bayar; ?>" readonly>
                        </div>
                        <small>Silahkan melakukan pembayaran dengan nominal tertera diatas</small>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Upload Bukti Transfer.</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                        <small> Jika pembayaran melalui bank transfer silahkan upload bukti transfer.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($pembayaran as $pembayaran) : ?>
    <!-- Modal Detail Pembayaran -->
    <div class="modal fade" id="detailPembayaran" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('pembayaran/konfirmasi') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="user_id" value="<?= $user_id; ?>">
                        <input type="hidden" class="form-control" name="kredit_id" value="<?= $kredit_id; ?>">
                        <input type="hidden" class="form-control" name="status" value="Menunggu Konfirmasi">
                        <div class="form-group">
                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                            <select class="form-control" name="jenis_pembayaran">
                                <option value="Tunai">Pembayaran Tunai</option>
                                <option value="Transfer">Pembayaran Transfer Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Nomor Kontrak</label>
                            <select class="form-control" name="no_kontrak">
                                <?php foreach ($kontrakList as $kredit) : ?>
                                    <option value="<?= $kredit['no_kontrak']; ?>"><?= $kredit['no_kontrak']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <small>Silahkan pilih nomor kontrak sebelum melakukan konfirmasi pembayaran</small>
                        </div>
                        <div class="form-group">
                            <label for="harga">Jumlah Bayar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" name="jumlah_bayar" value="<?= $total_bayar; ?>" readonly>
                            </div>
                            <small>Silahkan melakukan pembayaran dengan nominal tertera diatas</small>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Upload Bukti Transfer.</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                            <small> Jika pembayaran melalui bank transfer silahkan upload bukti transfer.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>