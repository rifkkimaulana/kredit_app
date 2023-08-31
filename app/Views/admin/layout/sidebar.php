<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard'); ?>" class="brand-link text-center">
        <img src="<?= base_url('assets/image/perusahaan/' . $perusahaan['logo']); ?>" alt="<?= $perusahaan['nama_perusahaan'] ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b><?= $perusahaan['nama_aplikasi']; ?></b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (!empty($user['user_foto'])) { ?>
                    <img src="<?= base_url('assets/image/user/' . $user['user_foto']); ?>" class="img-circle elevation-2" alt="<?= $user['user_nama'] ?>">
                <?php } else { ?>
                    <img src="<?= base_url('assets/image/user/avatar5.png'); ?>" class="img-circle elevation-2" alt="<?= $user['user_nama'] ?>">
                <?php } ?>
            </div>
            <div class="info">
                <a href="<?= base_url('profile'); ?>" class="d-block"><?= $user['user_nama']; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= $title === 'Dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= $title === 'Pengaturan' ? 'menu-open' : ''; ?>">
                    <a href="<?= base_url('pengaturan'); ?>" class="nav-link <?= $title === 'Pengaturan' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('profile'); ?>" class="nav-link <?= $title === 'Pengaturan Umum' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                    </ul>
                    <?php if ($user['user_level'] === 'administrator') : ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengaturan'); ?>" class="nav-link <?= $title === 'Pengaturan Umum' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengaturan Umum</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('users'); ?>" class="nav-link <?= $title === 'Users' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manajemen Users</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('setting/google_api'); ?>" class="nav-link <?= $title === 'Users' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Google Api Setting</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('email_setting'); ?>" class="nav-link <?= $title === 'Users' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Setting Email</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('whatsapp_api_setting'); ?>" class="nav-link <?= $title === 'Users' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Whatsapp API</p>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
                <?php if ($user['user_level'] === 'administrator') : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Produk
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('produk'); ?>" class="nav-link <?= $title === 'Produk' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('produk/kategori'); ?>" class="nav-link <?= $title === 'Produk' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ($user['user_level'] === 'administrator') : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Penjualan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('penjualan'); ?>" class="nav-link <?= $title === 'Penjualan' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Penjualan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('statistik'); ?>" class="nav-link <?= $title === 'Penjualan' ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Statistik Penjualan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Pembayaran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pembayaran'); ?>" class="nav-link <?= $title === 'Pembayaran' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembayaran Tagihan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('log_aktivitas'); ?>" class="nav-link <?= $title === 'Log Aktivitas' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Log Aktivitas</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>