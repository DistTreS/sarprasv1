<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="card p-4 shadow-lg border-0">
        <h2 class="text-primary mb-3">Detail Pengembalian</h2>

        <div class="mb-3">
            <p><strong>Nama Peminjam:</strong> <?= esc($peminjaman['user_name']) ?></p>
            <p><strong>Nama Aset:</strong> <?= esc($peminjaman['nama_kategori']); ?></p>
            <p><strong>Tanggal Pengembalian:</strong> 
                <?php if (!empty($peminjaman['tanggal_pengembalian'])): ?>
                    <span class="badge bg-success"><?= esc($peminjaman['tanggal_pengembalian']) ?></span>
                <?php else: ?>
                    <span class="badge bg-danger">Belum dikembalikan</span>
                <?php endif; ?>
            </p>
        </div>

        <h3 class="mt-4">Bukti Pengembalian</h3>
        <div class="text-center mt-3">
            <?php if (!empty($peminjaman['bukti_pengembalian'])): ?>
                <img src="<?= base_url('uploads/bukti_pengembalian/' . $peminjaman['bukti_pengembalian']) ?>" 
                     alt="Bukti Pengembalian" 
                     class="img-fluid rounded shadow-sm border" 
                     style="max-width: 350px; height: auto;">
            <?php else: ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <strong>Belum ada bukti pengembalian!</strong> Pengguna belum mengunggah bukti pengembalian aset.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>
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
