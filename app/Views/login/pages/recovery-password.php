<?= $this->extend('login/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url('/recovery/' . $token); ?>"><b><?= $perusahaan['nama_aplikasi']; ?></b></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('recovery'); ?>" method="post">
                <input type="hidden" class="form-control" name="token" value="<?= $token; ?>">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="<?= base_url('login'); ?>">Login</a>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>