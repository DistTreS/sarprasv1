<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

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

    input, select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        background-color: #fff;
        appearance: none; /* untuk tampilan select yang lebih konsisten di semua browser */
    }

    select {
        background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 10px;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <h2>Tambah Barang</h2>
    <form action="<?= site_url('inventaris/store'); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label>Satuan:</label>
            <input type="text" name="satuan" required>
        </div>

        <div class="form-group">
            <label>Nilai:</label>
            <input type="text" name="nilai" required>
        </div>

        <div class="form-group">
    <label for="keterangan">Jenis Barang:</label>
    <select name="deskripsi" id="keterangan" class="form-control" required>
        <option value="">-- Pilih Jenis Barang --</option>
        <option value="Persediaan">Persediaan</option>
        <option value="Habis Pakai">Habis Pakai</option>
    </select>
</div>

        <div class="form-footer">
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

