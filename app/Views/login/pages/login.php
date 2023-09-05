<?= $this->extend('login/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url('login'); ?>"> </a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

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

            <form action="<?= base_url('login'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email or Username" name="user" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="<?= base_url('google'); ?>" class="btn btn-block btn-danger" target="_blank">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
                <a href="<?= base_url('whatsapp'); ?>" class="btn btn-block btn-success">
                    <i class="fab fa-whatsapp mr-2"></i> Sign in using Whatsapp
                </a>
            </div>

            <p class="mb-1">
                <a href="<?= base_url('forgot-password'); ?>">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('register'); ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>