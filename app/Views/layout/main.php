<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Website'; ?></title>
    <link rel="stylesheet" href="<?= base_url('public/css/style.css'); ?>">
</head>
<body>
    <?= $this->include('layout/sidebar'); ?>

    <div style="margin-left: 250px; padding: 20px;">
        <?= $this->renderSection('content'); ?>
    </div>
</body>
</html>
