<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Aset</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <h2>Tambah Kategori Aset</h2>
        <form action="<?= base_url('kategoriAset/store'); ?>" method="POST">
            <label>Kode Kategori:</label>
            <input type="text" name="kode_kategori" required>

            <label>Nama Kategori:</label>
            <input type="text" name="nama_kategori" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" required></textarea>

            <button type="submit">Simpan</button>
            <a href="<?= base_url('kategoriAset'); ?>"><button type="button">Kembali</button></a>
        </form>
    </div>
</body>
</html>
