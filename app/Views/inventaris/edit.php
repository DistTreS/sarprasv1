<?= $this->include('layout/sidebar'); ?>

<h2>Edit Data Persediaan</h2>
<form action="<?= base_url('inventaris/update/' . $persediaan['id_barang']); ?>" method="post" enctype="multipart/form-data">
    <label>Nama Barang:</label>
    <input type="text" name="nama_barang" value="<?= $persediaan['nama_barang']; ?>" required><br>

    <label>Satuan:</label>
    <input type="text" name="satuan" value="<?= $persediaan['satuan']; ?>" required><br>

    <label>Nilai:</label>
    <input type="text" name="nilai" value="<?= $persediaan['nilai']; ?>" required><br>

    <label>Keterangan:</label>
    <input type="text" name="deskripsi" value="<?= $persediaan['deskripsi']; ?>" required><br>


    <button type="submit">Simpan Perubahan</button>
    <a href="<?= base_url('inventaris'); ?>">Batal</a>
</form>