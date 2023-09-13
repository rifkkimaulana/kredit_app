<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Label Voucher</title>

    <style>
        .qrcode-container {
            border: 1px solid #000;
            margin: 10px;
            display: inline-block;
            padding: 5px;
        }

        .qrcode {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <?php foreach ($qrCodeUrls as $qrCodeUrl) : ?>
        <div class="qrcode-container">
            <img class="qrcode" src="<?= $qrCodeUrl; ?>" alt="QR Code">
        </div>
    <?php endforeach; ?>

    <script>
        function printPage() {
            window.print();
        }

        window.onload = function() {
            printPage();
        };
    </script>
</body>

</html>