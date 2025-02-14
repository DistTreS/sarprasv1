<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="title">Detail Pengajuan Aset Rusak</h2>
    
    <?php if (!$asetRusak): ?>
        <div class="alert alert-danger">Data tidak ditemukan.</div>
    <?php else: ?>
        <div class="card custom-card">
            <div class="card-body">
                <table class="table table-bordered custom-table">
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
                        <td><?= esc($asetRusak['status_rusak']); ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td><?= esc($asetRusak['keterangan']); ?></td>
                    </tr>
                    <tr>
                        <th>Bukti Foto</th>
                        <td>
                            <?php if (!empty($asetRusak['bukti_foto'])): ?>
                                <img src="<?= base_url('uploads/aset_rusak/' . esc($asetRusak['bukti_foto'])); ?>" class="img-fluid proof-img" alt="Bukti Foto">
                            <?php else: ?>
                                <p class="text-muted">Tidak ada foto bukti.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <a href="<?= base_url('aset-rusak/riwayat'); ?>" class="btn btn-secondary custom-btn">Kembali</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .container {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        max-width: 800px;
    }
    .title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .custom-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
        padding: 20px;
    }
    .custom-table th {
        background: #007bff;
        color: #ffffff;
        padding: 10px;
        text-align: left;
    }
    .custom-table td {
        padding: 10px;
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
    .proof-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
        display: block;
        margin: 0 auto;
    }
</style>

<?= $this->endSection(); ?>
