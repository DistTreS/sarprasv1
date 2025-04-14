<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>

<h2>Daftar Kategori Aset</h2>

<form method="get" action="<?= base_url('pegawai/kategoriAset'); ?>" style="margin-bottom: 5px;">
    <input type="text" name="keyword" placeholder="Cari kode atau nama kategori" value="<?= esc($_GET['keyword'] ?? '') ?>" style="padding: 8px; width: 300px;">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
<!-- Tabel Daftar Kategori -->
<table class="table">
    <thead>
        <tr>
            <th class="header-No">No</th>
            <th class="header-Kode">Kode Kategori</th>
            <th class="header-Nama ">Nama Kategori</th>
            <th class="header-Deskripsi">Deskripsi</th>
            <th class="header-Jumlah Aset">Jumlah Aset</th>
            <th class="header-action">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($kategoriList as $kategori): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($kategori['kode_kategori']); ?></td>
                <td><?= esc($kategori['nama_kategori']); ?></td>
                <td><?= esc($kategori['deskripsi']); ?></td>
                <td><?= esc($kategori['jumlah_aset'] ?? 0); ?></td>
                <td>
                    <a href="<?= base_url('pegawai/kategoriAset/detail/' . $kategori['kode_kategori']); ?>" class="btn btn-info">
                        Lihat Aset
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🔹 CSS -->
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    h2 {
        margin-bottom: 10px;
        text-align: center; 
        font-size: x-large;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-No {
        background-color: #343a40;
        color: white;
    }

    .header-Kode {
        background-color: #343a40;
        color: white;
    }

    .header-Nama {
        background-color: #343a40;
        color: white;
    }

    .header-Deskripsi {
        background-color: #343a40;
        color: white;
    }

    .header-Jumlah {
        background-color: #343a40;
        color: white;
    }

    .header-action {
        background-color: #343a40;
        color: white;
    }

    
    .btn-info {
        display: inline-block;
        padding: 10px 10px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;

    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }
</style>

<?= $this->endSection(); ?>