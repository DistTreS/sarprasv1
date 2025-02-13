<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website'; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <?= $this->include('layout/sidebarpegawai'); ?>

        <!-- 🔹 Bungkus Konten & Footer dalam div -->
        <div class="content-wrapper">
            <div class="content">
                <?= $this->renderSection('content'); ?>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>Copyright 2024 - <span>PPSDM Kemendagri Regional Bukittinggi</span></p>
            </footer>
        </div>
    </div>
</body>

</html>
