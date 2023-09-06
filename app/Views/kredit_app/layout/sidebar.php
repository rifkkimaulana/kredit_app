<?php
$current_uri = uri_string();
$segments = explode('/', $current_uri);

$segment1 = isset($segments[0]) ? $segments[0] : '';
$segment2 = isset($segments[1]) ? $segments[1] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $segment1 === 'ka-dashboard' ? 'javascript:void(0);' : base_url('ka-dashboard'); ?>" class="brand-link text-center">
        <img src="<?= base_url('assets/image/perusahaan/' . $perusahaan['logo']); ?>" alt="<?= $perusahaan['nama_perusahaan'] ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b><?= $perusahaan['nama_aplikasi']; ?></b></span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (!empty($user['user_foto'])) { ?>
                    <img src="<?= base_url('assets/image/user/' . $user['user_foto']); ?>" class="img-circle elevation-2" alt="<?= $user['user_nama'] ?>">
                <?php } else { ?>
                    <img src="<?= base_url('assets/image/user/avatar5.png'); ?>" class="img-circle elevation-2" alt="<?= $user['user_nama'] ?>">
                <?php } ?>
            </div>
            <div class="info">
                <a href="<?= $segment2 === 'profile' ? 'javascript:void(0)' : base_url('ka-settings/profile'); ?>" class="d-block"><?= $user['user_nama']; ?></a>
            </div>
        </div>

        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= $segment1 === 'ka-dashboard' ? 'javascript:void(0);' : base_url('ka-dashboard'); ?>" class="nav-link <?= $segment1 === 'ka-dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item <?= $segment1 === 'ka-settings' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'ka-settings' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'profile' ? 'javascript:void(0)' : base_url('ka-settings/profile'); ?>" class="nav-link <?= $segment2 === 'profile' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                    </ul>

                    <?php if ($user['user_level'] === 'administrator') : ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'app' ? 'javascript:void(0)' : base_url('ka-settings/app'); ?>" class="nav-link <?= $segment2 === 'app' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengaturan Umum</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'users' ? 'javascript:void(0)' : base_url('ka-settings/users'); ?>" class="nav-link <?= $segment2 === 'users' ? 'active' : ''; ?>"> <i class="far fa-circle nav-icon"></i>
                                    <p>Manajemen Users</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'google_api' ? 'javascript:void(0)' : base_url('ka-settings/google_api'); ?>" class="nav-link <?= $segment2 === 'google_api' ? 'active' : ''; ?>"> <i class="far fa-circle nav-icon"></i>
                                    <p>Google Api</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'whatsapp_api' ? 'javascript:void(0)' : base_url('ka-settings/whatsapp_api'); ?>" class="nav-link <?= $segment2 === 'whatsapp_api' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Whatsapp API</p>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>

                <?php if ($user['user_level'] === 'administrator') : ?>
                    <li class="nav-item <?= $segment1 === 'ka-produk' ? 'menu-open' : ''; ?>">
                        <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'ka-produk' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Produk
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'produk' ? 'javascript:void(0)' : base_url('ka-produk/produk'); ?>" class="nav-link <?= $segment2 === 'produk' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'management_produk' ? 'javascript:void(0)' : base_url('ka-produk/management_produk'); ?>" class="nav-link <?= $segment2 === 'management_produk' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Management Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'kategori' ? 'javascript:void(0)' : base_url('ka-produk/kategori'); ?>" class="nav-link <?= $segment2 === 'kategori' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?= $segment1 === 'ka-transaksi' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'ka-transaksi' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'transaksi' ? 'javascript:void(0)' : base_url('ka-transaksi/transaksi'); ?>" class="nav-link <?= $segment2 === 'transaksi' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Management Transaksi</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'keranjang' ? 'javascript:void(0)' : base_url('ka-transaksi/keranjang'); ?>" class="nav-link <?= $segment2 === 'keranjang' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Keranjang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if ($user['user_level'] === 'administrator') : ?>
                    <li class="nav-item <?= $segment1 === 'paylater' ? 'menu-open' : ''; ?>">
                        <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'paylater' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Pay Later
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'pendaftaran_kontrak' ? 'javascript:void(0)' : base_url('paylater/pendaftaran_kontrak'); ?>" class="nav-link <?= $segment2 === 'pendaftaran_kontrak' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Form Pembelian Kredit</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'tagihan' ? 'javascript:void(0)' : base_url('paylater/tagihan'); ?>" class="nav-link <?= $segment2 === 'tagihan' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tagihan & Pembayaran</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'kontrak' ? 'javascript:void(0)' : base_url('paylater/kontrak'); ?>" class="nav-link <?= $segment2 === 'kontrak' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dokument Kontrak</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= $segment2 === 'peninjauan' ? 'javascript:void(0)' : base_url('paylater/peninjauan'); ?>" class="nav-link <?= $segment2 === 'peninjauan' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peninjauan Identitas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url('log_aktivitas'); ?>" class="nav-link <?= $segment1 === 'log_aktivitas' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Log Aktivitas</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- Modal Logout All Session -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="<?= base_url('logout'); ?>" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>