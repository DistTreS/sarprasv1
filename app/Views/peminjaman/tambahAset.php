<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h2>Tambah Aset Baru</h2>

<form action="<?= base_url('aset/store'); ?>" method="post" enctype="multipart/form-data">
    <label for="kategori">Kategori:</label>
    <select name="id_kategori">
        <?php foreach ($kategori as $kat): ?>
            <option value="<?= $kat['id_kategori']; ?>"><?= esc($kat['nama_kategori']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="status">Status:</label>
    <select name="status">
        <option value="Tersedia">Tersedia</option>
        <option value="Terpakai">Terpakai</option>
    </select>

    <label for="kondisi">Kondisi:</label>
    <select name="kondisi">
        <option value="Baik">Baik</option>
        <option value="Perbaikan">Perbaikan</option>
    </select>

    <label for="gambar">Gambar:</label>
    <input type="file" name="gambar">

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection(); ?>
