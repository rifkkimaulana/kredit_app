<?= $this->extend('Imasnet/Layout/Template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="<?= base_url('im-manajemen-voucher/riwayat/submitPengiriman'); ?>" method="post">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>

                        </div>
                        <div class="card-body">
                            <input type="text" value="<?= $voucher['id']; ?>" name="voucher_id">
                            <input type="text" value="<?= $voucher['paket_id']; ?>" name="paket_id">
                            <div class="form-group">
                                <label for="paket_id">Paket</label>
                                <input class="form-control" type="text" value="<?= $paket; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="server_id">Jaringan</label>
                                <select class="form-control select2" id="server_id" name="server_id" style="width: 100%;" required>
                                    <?php foreach ($serverData as $server) : ?>
                                        <option value="<?= $server['id']; ?>"><?= $server['nama_server']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reseller_id">Reseller</label>
                                <select class="form-control select2" id="reseller_id" name="reseller_id" style="width: 100%;" required>
                                    <?php foreach ($resellerData as $reseller) : ?>
                                        <option value="<?= $reseller['id']; ?>"><?= $reseller['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengirim_id">Pengirim</label>
                                <select class="form-control select2" id="pengirim_id" name="pengirim_id" style="width: 100%;" required>
                                    <?php foreach ($pengirimData as $pengirim) : ?>
                                        <option value="<?= $pengirim['id']; ?>"><?= $pengirim['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>