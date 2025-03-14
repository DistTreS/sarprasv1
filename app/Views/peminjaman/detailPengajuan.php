<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <!-- Header Formulir -->
    <div class="form-header">
    <img src="<?= base_url('assets/images/logo_ppsdm.png'); ?>" alt="Logo PPSDM" class="logo-ppsdm">

        <h2>Formulir Peminjaman Aset PPSDM Regional Bukittinggi</h2>
    </div>

    <!-- Informasi User -->
    <div class="user-info">
        <span class="badge-user">User#<?= esc($peminjaman['id_user']); ?></span>
        <a href="<?= base_url('peminjaman/cetak/' . $peminjaman['id_peminjaman']); ?>" class="btn-print">Print</a>
    </div>

    <!-- Tabel Informasi Peminjaman -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Aset</th>
                <th>Nama Aset</th>
                <th>CC</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= esc($peminjaman['id_aset']); ?></td>
                <td><?= esc($peminjaman['nama_aset']); ?></td>
                <td><?= esc($peminjaman['cc']); ?></td>
                <td><?= esc($peminjaman['keterangan']); ?></td>
                <td><?= esc($peminjaman['jumlah'] ?? '1 Unit'); ?></td>
                <td><?= !empty($peminjaman['no_telepon']) ? esc($peminjaman['no_telepon']) : 'Tidak tersedia'; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Informasi Tanggal dan Status -->
    <div class="info-status-container">
        <div class="info-tanggal">
            <p><strong>Tanggal Peminjaman:</strong> <?= esc($peminjaman['tanggal_pengajuan']); ?></p>
            <p><strong>Tanggal Rencana Pengembalian:</strong> <?= esc($peminjaman['tanggal_rencana_pengembalian']); ?></p>
            <p><strong>Tanggal Pengembalian:</strong> <?= !empty($peminjaman['tanggal_pengembalian']) ? esc($peminjaman['tanggal_pengembalian']) : '-'; ?></p>
        </div>
        <div class="status-container">
            <form action="<?= base_url('peminjaman/update_status/' . $peminjaman['id_peminjaman']); ?>" method="post" class="status-form">
                <label><strong>Status Peminjaman:</strong></label>
                <select name="status_peminjaman" class="status-dropdown">
                    <option value="Belum Disetujui" <?= ($peminjaman['status_peminjaman'] == 'Belum Disetujui') ? 'selected' : ''; ?>>Belum Disetujui</option>
                    <option value="Disetujui" <?= ($peminjaman['status_peminjaman'] == 'Disetujui') ? 'selected' : ''; ?>>Disetujui</option>
                </select>
                <button type="submit" class="btn-save">Simpan</button>
            </form>
            <p><strong>Status Pelayanan:</strong> 
                <span class="status-pelayanan <?= esc($peminjaman['status_layanan']); ?>">
                    <?= esc($peminjaman['status_layanan']); ?>
                </span>
            </p>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="<?= base_url('peminjaman'); ?>" class="btn-back">Kembali</a>
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

    .user-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .badge-user {
        background: blue;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
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

    .status-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-dropdown {
        padding: 7px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .status-container {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

    .btn-save {
        margin-top: 10px;
        align-self: flex-end;
    }


    .btn-save {
        background: #28a745;
        color: white;
        padding: 7px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-print {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        color: white;
        text-decoration: none;
        margin-top: 10px;
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

     .btn-print {
        background: #007bff;
    }

    .btn-back {
        background: #6c757d;
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
</style>

<?= $this->endSection() ?>
