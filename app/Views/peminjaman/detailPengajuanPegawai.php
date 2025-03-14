<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Header Formulir -->
    <div class="form-header">
        <img src="<?= base_url('assets/images/logo_ppsdm.png'); ?>" alt="Logo PPSDM" class="logo-ppsdm">
        <h2>Detail Peminjaman Aset</h2>
    </div>

    <!-- Tabel Informasi Peminjaman -->
    <table class="table">
        <thead>
            <tr>
                <th>NUP</th>
                <th>Nama Aset</th>
                <th>CC</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= esc($peminjaman['nup']); ?></td>
                <td><?= esc($peminjaman['nama_aset']); ?></td>
                <td><?= esc($peminjaman['CC']); ?></td>
                <td><?= esc($peminjaman['keterangan']); ?></td>
                <td><?= esc($peminjaman['jumlah'] ?? '1 Unit'); ?></td>
                <td><?= !empty($peminjaman['no_telepon']) ? esc($peminjaman['no_telepon']) : 'Tidak tersedia'; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Informasi Tanggal dan Status -->
    <div class="info-status-container">
        <div class="info-tanggal">
            <p><strong>Tanggal Peminjaman:</strong> <?= esc($peminjaman['tanggal_peminjaman']); ?></p>
            <p><strong>Tanggal Rencana Pengembalian:</strong> <?= esc($peminjaman['tanggal_rencana_pengembalian']); ?></p>
            <p><strong>Tanggal Pengembalian:</strong> <?= !empty($peminjaman['tanggal_pengembalian']) ? esc($peminjaman['tanggal_pengembalian']) : '-'; ?></p>
        </div>
        <div class="status-container">
            <p><strong>Status Peminjaman:</strong> 
                <span class="status-pelayanan <?= esc($peminjaman['status_peminjaman']); ?>">
                    <?= esc($peminjaman['status_peminjaman']); ?>
                </span>
            </p>
            <p><strong>Status Layanan:</strong> 
                <span class="status-pelayanan <?= esc($peminjaman['status_layanan']); ?>">
                    <?= esc($peminjaman['status_layanan']); ?>
                </span>
            </p>
        </div>
    </div>

    <!-- Informasi Bukti Pengembalian -->
    <div class="bukti-container">
    <h3>Bukti Pengembalian</h3>

    <?php if (empty($peminjaman['bukti_pengembalian'])) : ?>
        <div class="alert alert-warning">
            <strong>Bukti pengembalian ditolak, silakan upload ulang bukti pengembalian.</strong>
        </div>

    <?php elseif (!empty($peminjaman['bukti_pengembalian']) && $peminjaman['status_layanan'] !== 'Selesai') : ?>
        <div class="alert alert-info">
            <strong>Bukti pengembalian telah diupload, silakan tunggu persetujuan.</strong>
        </div>

    <?php elseif (!empty($peminjaman['bukti_pengembalian']) && $peminjaman['status_layanan'] === 'Selesai') : ?>
        <img src="<?= base_url('uploads/bukti_pengembalian/' . esc($peminjaman['bukti_pengembalian'])) ?>" 
             alt="Bukti Pengembalian" 
             style="max-width:300px; display:block;">
        <div class="alert alert-success">
            <strong>Pengembalian telah disetujui.</strong>
        </div>
    <?php endif; ?>
</div>





    <!-- Tombol Kembali -->
    <a href="<?= base_url('pegawai/peminjaman'); ?>" class="btn-back">Kembali</a>
</div>

<!-- CSS Styling -->
<style>
    .container {
        padding: 30px;
        max-width: 90%;
        margin: auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 15px;
    }

    .logo-ppsdm {
        width: 60px;
        height: auto;
    }

    .form-header h2 {
        font-size: 22px;
        color: #333;
        font-weight: bold;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .info-status-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .status-container {
        text-align: right;
    }

    .status-pelayanan {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status-pelayanan.Pengajuan {
        background: #ff9800;
        color: white;
    }

    .status-pelayanan.Proses {
        background: #007bff;
        color: white;
    }

    .status-pelayanan.Selesai {
        background: #28a745;
        color: white;
    }

    .status-pelayanan.Disetujui {
        background: #17a2b8;
        color: white;
    }

    .status-pelayanan.BelumDisetujui {
        background: #dc3545;
        color: white;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        color: white;
        text-decoration: none;
        margin-top: 10px;
        background: #6c757d;
    }

    .alert {
        padding: 10px;
        background: #f8d7da;
        color: #721c24;
        border-radius: 5px;
    }

    .btn-primary {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        color: white;
        background: #007bff;
        text-decoration: none;
        margin-top: 10px;
    }
</style>

<?= $this->endSection() ?>
