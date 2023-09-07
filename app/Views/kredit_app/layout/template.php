<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/image/perusahaan/' . $perusahaan['logo']) ?>" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?= $this->include('kredit_app/layout/navbar'); ?>
        <?= $this->include('kredit_app/layout/sidebar'); ?>

        <div class="content-wrapper">
            <div class="card"></div>
            <?= $this->renderSection('content'); ?>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2023. <?= $perusahaan['nama_perusahaan']; ?>. </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1
            </div>
        </footer>
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
    <!-- ChartJS -->
    <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?= base_url('assets/plugins/sparklines/sparkline.js'); ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('assets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url('assets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('assets/plugins/moment/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <!-- Summernote -->
    <script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.js'); ?>"></script>

    <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

    <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>

    <script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $("#tableAddPenjualan").DataTable({
                paging: false,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    lengthMenu: "_MENU_",
                    zeroRecords: "No data found",
                    info: "",
                    infoEmpty: "",
                    infoFiltered: "",
                    search: "Cari:",
                },
                lengthMenu: [5, 10],
                pageLength: 5,
            });

            $("#selectLength").on("change", function() {
                table.page.len($(this).val()).draw();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#tablerifkkimaulana").DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    lengthMenu: "_MENU_",
                    zeroRecords: "No data found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    search: "Cari:",
                    paginate: {
                        first: "Start",
                        last: "End",
                        next: "Next",
                        previous: "Previous",
                    },
                },
                lengthMenu: [5, 10, 50, 100],
                pageLength: 5,
            });

            $("#selectLength").on("change", function() {
                table.page.len($(this).val()).draw();
            });

            // Identifikasi plugin select2
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            // Inisialisasi Notifikasi all pages from session
            <?php if (session()->getFlashdata('success')) : ?>
                toastr.success('<?= session()->getFlashdata('success') ?>');
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                toastr.error('<?= session()->getFlashdata('error') ?>');
            <?php endif; ?>

            // Copy No Rekening
            $("#copyIcon1").click(function() {
                // Pilih teks dalam input
                var copyText = document.getElementById("nomorRekening1");

                // Salin teks ke clipboard
                copyText.select();
                document.execCommand("copy");

                // Tampilkan pemberitahuan bahwa teks telah disalin
                alert("Nomor rekening telah disalin: " + copyText.value);
            });
            $("#copyIcon2").click(function() {
                // Pilih teks dalam input
                var copyText = document.getElementById("nomorRekening2");

                // Salin teks ke clipboard
                copyText.select();
                document.execCommand("copy");

                // Tampilkan pemberitahuan bahwa teks telah disalin
                alert("Nomor rekening telah disalin: " + copyText.value);
            });
            $("#copyIcon3").click(function() {
                // Pilih teks dalam input
                var copyText = document.getElementById("nomorRekening3");

                // Salin teks ke clipboard
                copyText.select();
                document.execCommand("copy");

                // Tampilkan pemberitahuan bahwa teks telah disalin
                alert("Nomor rekening telah disalin: " + copyText.value);
            });
        });
    </script>


    <script>
        $('#nomorKontrakSelect').change(function() {
            var selectedValue = $(this).val();
            // Kirim data ke server melalui AJAX
            $.ajax({
                type: 'POST',
                url: 'pembayaran',
                data: {
                    no_kontrak: selectedValue
                }, // Data yang akan dikirim
                success: function(response) {
                    // Ubah nilai harga pembayaran dengan nilai yang diterima dari server
                    $('#totalBayarDisplay').val('Rp. ' + response.total_bayar.toLocaleString()); // Menampilkan harga dalam format yang sesuai
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan: ' + error);
                }
            });
        });
    </script>

</body>

</html>