<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <form role="form" method="post" action="<?= base_url('whatsapp_api_setting'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#configuration" data-toggle="tab">Konfigurasi</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content ">
                                <div class="active tab-pane" id="configuration">
                                    <div class="form-group">
                                        <label for="user_level">Provider API Whatsapp</label>
                                        <select class="form-control" name="providerApi">
                                            <option value="wablas">WABLAS (Recomended)</option>
                                        </select>
                                        <small> Silahkan pilih salah satu server wa gateway yang anda gunakan</small>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Domain</label>
                                        <input type="text" class="form-control" name="domain" value="<?= $wa['domain'] ?>">
                                        <small> Contoh domain: https://kudus.wablas.com/api/send-message</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Api Wablas Token</label>
                                        <input type="password" class="form-control" name="token_api" value="<?= $wa['token_api'] ?>">
                                        <small> Silahkan input apikey wablas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->

<?= $this->endSection(); ?>