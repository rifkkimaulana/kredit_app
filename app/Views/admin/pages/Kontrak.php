<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createKontrak">
                            Create New
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">Status</th>
                                        <th class="text-center" style="padding: 10px;">Nomor Kontrak</th>
                                        <th class="text-center" style="padding: 10px;">Nama Lengkap</th>
                                        <th class="text-center" style="padding: 10px;">Total Pembelian</th>
                                        <th class="text-center" style="padding: 10px;">Lunas</th>
                                        <th class="text-center" style="padding: 10px;">Belum Lunas</th>
                                        <th class="text-center" style="padding: 10px;">Tanggal Dibuat</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kontrakList as $kontrak) : ?>
                                        <?php
                                        $Pembayaran = $kontrak['total_kredit'] / $kontrak['jangka_waktu'];

                                        $baruTerbayar = $jumlah_terbayar * $Pembayaran;
                                        $belumLunas = ($kontrak['total_kredit']) - ($baruTerbayar); ?>

                                        <td class="text-center">
                                            <?php if ($belumLunas === 0) { ?>
                                                <a class="btn btn-danger btn-sm">Selesai</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-sm">Active</a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?= $kontrak['no_kontrak'] ?></td>
                                        <td class="text-center"><?= $userMap[$kontrak['user_id']]['user_nama'] ?></td>
                                        <td class="text-center"> Rp. <?= number_format($kontrak['total_kredit'], 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($baruTerbayar, 0, ',', '.'); ?></td>
                                        <td class="text-center"> Rp. <?= number_format($belumLunas, 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= $kontrak['created_at'] ?></td>
                                        <td class="text-center">

                                            <a data-toggle="modal" data-target="#detailPembayaran<?= $kontrak['id'] ?>" class="btn btn-primary btn-sm">
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


<!-- Modal Create Kontrak -->
<div class="modal fade" id="createKontrak" tabindex="-1" role="dialog" aria-labelledby="createKontrakLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKontrakLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('paylater/kontrak/new') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_id">Kategori Produk</label>
                                <select class="form-control" id="kategori_id" name="kategori_id">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" value="tidak ada keterangan"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="harga" name="harga" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" value="1">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>