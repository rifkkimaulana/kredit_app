<?= $this->extend('kredit_app/layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-danger">403</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Access Denied.</h3>
            <p>
                Anda tidak memiliki akses ke halaman ini.
                Silakan <a href="<?= base_url('ka-dashboard'); ?>">kembali ke halaman utama</a> atau hubungi administrator.
            </p>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>