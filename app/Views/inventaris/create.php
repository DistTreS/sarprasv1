<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<form action="<?= site_url('inventaris/store'); ?>" method="post" enctype="multipart/form-data">
    <label>Nama Barang:</label>
    <input type="text" name="nama barang" required>

    <label>Satuan:</label>
    <input type="text" name="satuan" required>

    <label>Nilai:</label>
    <input type="text" name="nilai" required>

    <label>Keterangan:</label>
    <input type="text" name="keterangan" required>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>

