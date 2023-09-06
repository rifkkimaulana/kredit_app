<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <form role="form" method="post" action="<?= base_url('ka-settings/google_api'); ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content ">
                                <div class="active tab-pane" id="configuration">
                                    <div class="form-group">
                                        <label>Client ID</label>
                                        <input type="password" class="form-control" name="client_id" value="<?= $google['client_id'] ?>">
                                        <small>Copy Client ID Google Api Oauth Login</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Client Secret</label>
                                        <input type="password" class="form-control" name="client_secret" value="<?= $google['client_secret'] ?>">
                                        <small>Copy Client Secret Google Api Oauth Login.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
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