<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="card p-4 shadow-lg border-0">
        <h2 class="text-primary mb-3">Detail Pengembalian</h2>
        <p><strong>Nama Peminjam:</strong> <?= esc($peminjaman['user_name']) ?></p>
        <p><strong>Nama Aset:</strong> <?= esc($peminjaman['nama_kategori']); ?></p>
        <p><strong>Tanggal Pengembalian:</strong> <?= !empty($peminjaman['tanggal_pengembalian']) ? esc($peminjaman['tanggal_pengembalian']) : '<span class="text-danger">Belum dikembalikan</span>' ?></p>

        <h3 class="mt-4">Bukti Pengembalian</h3>
        <?php if (!empty($peminjaman['bukti_pengembalian'])): ?>
            <img src="<?= base_url('uploads/bukti_pengembalian/' . $peminjaman['bukti_pengembalian']) ?>" alt="Bukti Pengembalian" class="img-fluid rounded shadow-sm border" width="300">
        <?php else: ?>
            <p class="text-danger">Tidak ada bukti pengembalian</p>
        <?php endif; ?>
    </div>

    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary mt-4">Kembali ke Riwayat</a>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
    }
    .btn {
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        transition: all 0.3s ease-in-out;
    }
    .btn-success {
        background: #28a745;
        color: white;
        border: none;
    }
    .btn-success:hover {
        background: #218838;
    }
    .btn-secondary {
        background: #007bff;
        color: white;
    }
    .btn-secondary:hover {
        background: #0056b3;
    }
    .card {
        border-radius: 10px;
        background: #ffffff;
        padding: 25px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        transition: transform 0.3s ease-in-out;
    }
    .img-fluid:hover {
        transform: scale(1.05);
    }
    .text-danger {
        font-weight: bold;
    }
</style>

<?= $this->endSection() ?>
