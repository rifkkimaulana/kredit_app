<?= $this->extend('MetaView/layout/template'); ?>
<?= $this->section('meta-content'); ?>

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
                            <table id="tablemeta_rg" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="padding: 10px;">Aplication Name</th>
                                        <th class="text-center" style="padding: 10px;">Keterangan</th>
                                        <th class="text-center" style="padding: 10px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($appList as $app) : ?>
                                        <tr>
                                            <td class="text-center"><?= $app['nama_aplikasi']; ?></td>
                                            <td class="text-center"><?= $app['keterangan']; ?></td>

                                            <td class="text-center">
                                                <form action="<?= base_url('meta/open/aplication'); ?>" method="post">
                                                    <input type="hidden" class="form-control" name="app_id" value="<?= $app['id']; ?>">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Open <i class="fas fa-sign-in-alt"></i>
                                                    </button>
                                                </form>
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

<?= $this->endSection(); ?>