<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>

<h2>Daftar Kategori Aset</h2>

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
        <?php $no = 1; foreach ($kategoriList as $kategori): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($kategori['kode_kategori']); ?></td>
            <td><?= esc($kategori['nama_kategori']); ?></td>
            <td><?= esc($kategori['deskripsi']); ?></td>
            <td><?= esc($kategori['jumlah_aset'] ?? 0); ?></td>
            <td>
                <a href="<?= base_url('pegawai/kategoriAset/detail/' . $kategori['kode_kategori']); ?>" class="btn btn-info">
                    <i class="fas fa-eye"></i> Lihat Aset
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
        margin-top: 20px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-No {background-color: #34495E; color: white;}
    .header-Kode { background-color: #2C3E50; color: white; }
    .header-Nama { background-color: #2C3E50; color: white; }
    .header-Deskripsi  { background-color: #1B4F72; color: white; }
    .header-Jumlah  { background-color: #154360; color: white; }
    .header-action  { background-color: #0E6251; color: white; }

    .btn-success { background-color: #28a745; color: white; }
    .btn-secondary { background-color: #6c757d; color: white; }
    .close { position: absolute; top: 10px; right: 20px; font-size: 24px; cursor: pointer; }
</style>

<?= $this->endSection(); ?>
