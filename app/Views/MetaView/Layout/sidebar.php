<?php
$current_uri = uri_string();
$segments = explode('/', $current_uri);

$segment1 = isset($segments[1]) ? $segments[1] : '';
$segment2 = isset($segments[2]) ? $segments[2] : '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $segment1 === 'dashboard' ? 'javascript:void(0);' : base_url('dashboard'); ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>META RG PANEL</b></span>
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
                <a href="<?= $segment1 === 'app_management' ? 'javascript:void(0);' : base_url('meta/app_management'); ?>" class="d-block"><?= $user['user_nama']; ?></a>
            </div>
        </div>

        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $segment1 === 'dashboard' ? 'javascript:void(0);' : base_url('meta/dashboard'); ?>" class="nav-link <?= $segment1 === 'dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $segment1 === 'user_management' ? 'javascript:void(0);' : base_url('meta/user_management'); ?>" class="nav-link <?= $segment1 === 'user_management' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User Management</p>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $segment1 === 'app_management' ? 'javascript:void(0);' : base_url('meta/app_management'); ?>" class="nav-link <?= $segment1 === 'app_management' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Management Application</p>
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