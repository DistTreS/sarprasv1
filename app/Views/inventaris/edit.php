<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 600px; 
        margin: 20px auto;
        border: 2px solid #ddd;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
    }

    .form-footer {
        display: flex;
        justify-content: space-between; /* Align buttons on opposite sides */
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        transition: background 0.3s;
        display: inline-block;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #999;
    }
</style>

<div class="container">
    <h2>Edit Data Persediaan</h2>
    <form action="<?= base_url('inventaris/update/' . $persediaan['id_barang']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" value="<?= $persediaan['nama_barang']; ?>" required>
        </div>

        <div class="form-group">
            <label>Satuan:</label>
            <input type="text" name="satuan" value="<?= $persediaan['satuan']; ?>" required>
        </div>

        <div class="form-group">
            <label>Nilai:</label>
            <input type="text" name="nilai" value="<?= $persediaan['nilai']; ?>" required>
        </div>

        <div class="form-group">
            <label>Keterangan:</label>
            <input type="text" name="deskripsi" value="<?= $persediaan['deskripsi']; ?>" required>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary" >Simpan Perubahan</button>
            <a href="<?= base_url('inventaris/index'); ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>


<?= $this->endSection() ?>