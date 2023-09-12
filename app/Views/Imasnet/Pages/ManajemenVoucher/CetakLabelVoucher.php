<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Label Voucher</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css'); ?>">

    <style>
        .card {
            border: 1px solid #000;
            /* Warna dan ketebalan garis pinggir */
        }
    </style>

</head>

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    $no = 1;
                    foreach ($voucherData as $voucher) : ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Label Voucher</h5>
                                    <div class="float-right">
                                        <?= $no++; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="komentar">
                                        <p>Kode: <?= $voucher['code']; ?></p>
                                        <p>Paket: <?= $paketMap[$voucher['paket_id']]['nama_paket']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.js'); ?>"></script>
</body>

</html>