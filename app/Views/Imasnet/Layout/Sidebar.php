<?php
$current_uri = uri_string();
$segments = explode('/', $current_uri);

$segment1 = isset($segments[0]) ? $segments[0] : '';
$segment2 = isset($segments[1]) ? $segments[1] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $segment1 === 'im-dashboard' ? 'javascript:void(0);' : base_url('im-dashboard'); ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>META IMASNET PANEL</b></span>
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
                <li class="nav-item">
                    <a href="<?= $segment1 === 'im-dashboard' ? 'javascript:void(0);' : base_url('im-dashboard'); ?>" class="nav-link <?= $segment1 === 'im-dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
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