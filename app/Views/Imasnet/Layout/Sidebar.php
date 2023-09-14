<?php
$current_uri = uri_string();
$segments = explode('/', $current_uri);

$segment1 = isset($segments[0]) ? $segments[0] : '';
$segment2 = isset($segments[1]) ? $segments[1] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $segment1 === 'im-dashboard' ? 'javascript:void(0);' : base_url('im-dashboard'); ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>IMASNET PANEL</b></span>
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
                <a class="d-block"><?= $user['user_nama']; ?></a>
            </div>
        </div>

        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item">
                    <a href="<?= $segment1 === 'im-dashboard' ? 'javascript:void(0);' : base_url('im-dashboard'); ?>" class="nav-link <?= $segment1 === 'im-dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">PENGELOLA PERALATAN</li>
                <li class="nav-item <?= $segment1 === 'im-manajemen-assets' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-manajemen-assets' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Manajemen Aset
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-assets/data-aset'); ?>" class="nav-link <?= $segment2 === 'data-aset' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Aset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-assets/kategori-aset'); ?>" class="nav-link <?= $segment2 === 'kategori-aset' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Aset</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= $segment1 === 'im-inventory' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-inventory' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Manajemen Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'inventory' ? 'javascript:void(0)' : base_url('im-inventory/inventory'); ?>" class="nav-link <?= $segment2 === 'inventory' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Inventory</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/location'); ?>" class="nav-link <?= $segment2 === 'location' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Location</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/suppliers'); ?>" class="nav-link <?= $segment2 === 'suppliers' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suppliers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/customers'); ?>" class="nav-link <?= $segment2 === 'customers' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/categories'); ?>" class="nav-link <?= $segment2 === 'categories' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/transaction'); ?>" class="nav-link <?= $segment2 === 'transaction' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-inventory/history'); ?>" class="nav-link <?= $segment2 === 'history' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>History</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">PENGELOLA PELANGGAN</li>
                <li class="nav-item <?= $segment1 === 'im-manajemen-server' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-manajemen-server' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Manajemen Server
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-server/server'); ?>" class="nav-link <?= $segment2 === 'server' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengelola Server</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-server/users-pengelola'); ?>" class="nav-link <?= $segment2 === 'users-pengelola' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users Pengelola</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= $segment1 === 'im-manajemen-customer' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-manajemen-customer' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manajemen Pelanggan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-customer/customer'); ?>" class="nav-link <?= $segment2 === 'customer' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pelanggan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Menu Manajemen Voucher -->
                <li class="nav-item <?= $segment1 === 'im-manajemen-voucher' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-manajemen-voucher' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Manajemen Voucher
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-voucher/voucher'); ?>" class="nav-link <?= $segment2 === 'voucher' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-voucher/paket'); ?>" class="nav-link <?= $segment2 === 'paket' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paket Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-voucher/reseller'); ?>" class="nav-link <?= $segment2 === 'reseller' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resseler Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-voucher/pengirim'); ?>" class="nav-link <?= $segment2 === 'pengirim' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengirim Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-voucher/riwayat'); ?>" class="nav-link <?= $segment2 === 'riwayat' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">PENGELOLA KEUANGAN</li>
                <li class="nav-item <?= $segment1 === 'im-manajemen-keuangan' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-manajemen-keuangan' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Manajemen Keuangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/data-keuangan'); ?>" class="nav-link <?= $segment2 === 'data-keuangan' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/kategori-keuangan'); ?>" class="nav-link <?= $segment2 === 'kategori-keuangan' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/jenis-keuangan'); ?>" class="nav-link <?= $segment2 === 'jenis-keuangan' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/pengelola-keuangan'); ?>" class="nav-link <?= $segment2 === 'pengelola-keuangan' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengelola Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/riwayat-transaksi'); ?>" class="nav-link <?= $segment2 === 'riwayat-transaksi' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('im-manajemen-keuangan/laporan-keuangan'); ?>" class="nav-link <?= $segment2 === 'laporan-keuangan' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Keuangan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">TOOL SYSTEM</li>
                <li class="nav-item <?= $segment1 === 'im-settings' ? 'menu-open' : ''; ?>">
                    <a href="javascript:void(0);" class="nav-link <?= $segment1 === 'im-settings' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'profile' ? 'javascript:void(0)' : base_url('im-settings/profile'); ?>" class="nav-link <?= $segment2 === 'profile' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= $segment2 === 'users' ? 'javascript:void(0)' : base_url('im-settings/users'); ?>" class="nav-link <?= $segment2 === 'users' ? 'active' : ''; ?>"> <i class="far fa-circle nav-icon"></i>
                                <p>Manajemen Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('im-log/activity'); ?>" class="nav-link <?= $segment2 === 'activity' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Aktifitas</p>
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