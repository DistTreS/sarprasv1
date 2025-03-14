<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="card custom-card">
        <div class="card-header text-center custom-header">
            <h2 class="title">Detail Pengajuan Aset Rusak</h2>
        </div>
        <div class="card-body">
            <?php if (!$asetRusak): ?>
                <div class="alert alert-danger">Data tidak ditemukan.</div>
            <?php else: ?>
                <table class="table custom-table">
                    <tr>
                        <th>Kategori Aset</th>
                        <td><?= esc($asetRusak['nama_kategori']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td><?= esc($asetRusak['tanggal_pengajuan']); ?></td>
                    </tr>
                    <tr>
                        <th>Status Kerusakan</th>
                        <td>
                            <?php 
                                $status = strtolower($asetRusak['status_kerusakan']);
                                $statusColor = 'gray';

                                if ($status === 'baik') {
                                    $statusColor = 'green';
                                } elseif ($status === 'rusak ringan') {
                                    $statusColor = 'orange';
                                } elseif ($status === 'rusak berat') {
                                    $statusColor = 'red';
                                }
                            ?>
                            <span class="status-badge" style="background: <?= $statusColor ?>;">
                                <?= esc($asetRusak['status_kerusakan']); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td><?= esc($asetRusak['keterangan']); ?></td>
                    </tr>
                    <tr>
                        <th>Bukti Foto</th>
                        <td class="text-center">
                            <div class="image-container">
                                <?php if (!empty($asetRusak['bukti_foto'])): ?>
                                    <?php foreach (explode(',', $asetRusak['bukti_foto']) as $foto): ?>
                                        <img src="<?= base_url('uploads/aset_rusak/' . esc($foto)); ?>" class="proof-img" alt="Bukti Foto">
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">Tidak ada foto bukti.</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <a href="<?= base_url('aset-rusak/riwayat'); ?>" class="btn custom-btn">Kembali</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background: #f4f4f9;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
    }
    .custom-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.28);
    }
    .custom-header {
        background:white;
        color: black;
        padding: 15px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    .custom-table th, .custom-table td {
        padding: 12px;
        border: px solid #ddd;
    }
    .custom-table th {
        background:white;
        color: black;
        text-align: left;
    }
    .status-badge {
        color: white;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
    }
    .image-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }
    .proof-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }
    .proof-img:hover {
        transform: scale(1.1);
    }
    .custom-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        margin-top: 15px;
        background: #007bff;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }
    .custom-btn:hover {
        background: #0056b3;
    }
</style>

<?= $this->endSection(); ?>
