<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>

<h2><?= esc($title); ?></h2><form action="<?= base_url('peminjaman/cariAsetPegawai/' . esc($kode_kategori ?? '')); ?>" method="get" class="form-inline">
    <input type="text" name="search" value="<?= esc($search ?? ''); ?>" placeholder="Cari Nama Aset atau NUP" class="form-control" required style="padding: 8px; width: 300px;">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>



<!-- 🔹 Tabel Daftar Aset -->
<table class="table">
    <thead>
        <tr>
            <th class="header-id">Nama Aset</th>
            <th class="header-id">NUP</th>
            <th class="header-kondisi">Kondisi</th>
            <th class="header-status_aset">Status Aset</th>
            <th class="header-gambar">Gambar</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($asetList as $aset): ?>
        <tr>
            <td><?= esc($aset['nama_aset']); ?></td>
            <td><?= esc($aset['nup']); ?></td> <!-- Menampilkan ID Aset -->
            <td><?= esc($aset['kondisi']); ?></td>
            <td><?= esc($aset['status_aset']); ?></td>
            <td>
                <img src="<?= base_url('uploads/aset/' . esc($aset['gambar'])); ?>" class="gambar-aset" alt="Gambar Aset">
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🔹 Tombol Kembali -->
<a href="<?= base_url('pegawai/kategoriAset'); ?>" class="btn btn-secondary kembali">Kembali</a>

<!-- 🔹 CSS -->
<style>
    /* Styling Tombol Tambah Aset */
    .btn-tambah {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        margin-bottom: 15px;
    }

    /* Styling Pop-up Modal Sesuai Gambar */
    .modal {
        display: none; /* Menyembunyikan modal saat halaman dimuat */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    h2 {
        margin-bottom: 10px; 
        font-size: x-large;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        margin: 10% auto;
        width: 50%;
        border-radius: 10px;
        position: relative;
        text-align: left;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .modal-content h3 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .modal-content label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .modal-content input[type="text"],
    .modal-content select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .modal-content .gambar-preview {
        display: block;
        width: 150px;
        height: 150px;
        margin: 10px auto;
        border: 1px solid #ccc;
        object-fit: cover;
    }

    .modal-content button {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-content .btn-success {
        background-color: #28a745;
        color: white;
    }

    .modal-content .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }

    /* Styling Tabel */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-id {background-color: #343a40; color: white;}
    .header-kondisi { background-color: #343a40; color: white; }
    .header-status_aset  { background-color: #343a40; color: white; }
    .header-gambar  { background-color: #343a40; color: white; }
    .header-action  { background-color: #343a40; color: white; }

    .gambar-aset {
        width: 60px; 
        height: 60px; 
        object-fit: contain; 
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Tombol Kembali */
    .kembali {
        display: block;
    width: 100%; /* Biar selebar kontainer */
    max-width: 400px; /* Batas maksimal lebarnya */
    padding: 12px 20px;
    margin: 30px auto; /* Tengah horizontal */
    background-color: #6c757d;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    text-align: center;
    font-size: 16px;
    box-sizing: border-box;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: background-color 0.3s ease;
    }

    .kembali:hover {
        background-color: #545b62;
    }

    /* Styling Gambar Preview */
    .gambar-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ccc;
        display: block;
        margin: 10px auto;
    }
</style>

<?= $this->endSection(); ?>