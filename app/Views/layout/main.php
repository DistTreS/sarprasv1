<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website'; ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (wajib untuk Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <?= $this->include('layout/sidebar'); ?>

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
