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
    <?= $this->include('layout/sidebar'); ?>

    <div class="content">
        <?= $this->renderSection('content'); ?>
    </div>
</body>

</html>