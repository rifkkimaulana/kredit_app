<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="<?= base_url('im-manajemen-voucher/voucher/delete/checkbox'); ?>" method="post">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>
                            <div class="float-right">
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus"></i> Generate Label
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-trash"> </i> Hapus Terpilih</button>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#cetakModal">
                                    <i class="fas fa-print"></i> Cetak
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Paket</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Komentar</th>
                                            <th class="text-center">Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($voucherData as $voucher) : ?>
                                            <tr>

                                                <td class="text-center">
                                                    <input type="checkbox" class="checkbox-item" name="voucher_ids[]" value="<?= $voucher['id']; ?>">
                                                </td>
                                                <td class="text-center"><?= $no++; ?></td>
                                                <td class="text-center"><?= $paketMap[$voucher['paket_id']]['nama_paket']; ?></td>
                                                <td class="text-center"><?= $voucher['code']; ?></td>
                                                <td class="text-center"><?= $voucher['komentar']; ?></td>
                                                <td class="text-center"><?= $voucher['created_at']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
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
                        <label for="jumlah">Jumlah Generate</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
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

<!-- Modal Pilih Komentar untuk Cetak -->
<div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakModalLabel">Pilih Komentar untuk Cetak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $komentarUnik = [];
            foreach ($voucherData as $voucher) {
                if (!in_array($voucher['komentar'], $komentarUnik)) {
                    $komentarUnik[] = $voucher['komentar'];
                }
            }
            ?>
            <form action="<?= base_url('im-manajemen-voucher/voucher/cetak'); ?>" method="get">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="komentar">Pilih Komentar</label>
                        <select name="komentar" id="komentar" class="form-control">
                            <option value="">Pilih Komentar</option>
                            <?php foreach ($komentarUnik as $komentar) : ?>
                                <option value="<?= $komentar; ?>"><?= $komentar; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>