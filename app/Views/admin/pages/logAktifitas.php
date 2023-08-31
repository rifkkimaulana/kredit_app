<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('produk'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#removeActivity" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Bersihkan Log Aktifitas
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablerifkkimaulana" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding: 10px;">No</th>
                                            <th class="text-center" style="padding: 10px;">User</th>
                                            <th class="text-center" style="padding: 10px;">Keterangan</th>
                                            <th class="text-center" style="padding: 10px;">Ip Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($aktifitas as $aktifitas) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $aktifitas['user_id'] ?></td>
                                                <td class="text-center"><?= $aktifitas['keterangan'] ?></td>
                                                <td class="text-center"><?= $aktifitas['ip_address'] ?></td>

                                                <a data-toggle="modal" data-target="#editModal<?= $penjualan['id'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
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
        </form>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>