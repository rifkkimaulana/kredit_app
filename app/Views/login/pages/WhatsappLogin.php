<?= $this->extend('login/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url('/forgot-password'); ?>"> </a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login Menggunakan Whatsapp Number.</p>

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

            <form action="<?= base_url('whatsapp/send_otp'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Contoh. 628x-xxxx-xxxx" name="no_wa" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Kirim Link Login</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="<?= base_url('login'); ?>">Login</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('register'); ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>