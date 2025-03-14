<?= $this->extend('layout/mainpegawai'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2>Riwayat Pengajuan Aset Rusak</h2>

    <!-- Tombol Pengajuan Aset Rusak -->
    <div class="mb-3">
        <a href="<?= base_url('aset-rusak/pengajuan'); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Pengajuan Aset Rusak
        </a>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"> <?= session()->getFlashdata('success'); ?> </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"> <?= session()->getFlashdata('error'); ?> </div>
    <?php endif; ?>

    <!-- Tabel Riwayat Aset Rusak -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Aset</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status Kerusakan</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($asetRusakList)): ?>
                    <?php foreach ($asetRusakList as $aset): ?>
                        <tr>
                            <td><?= esc($aset['nama_aset']); ?></td>
                            <td><?= esc($aset['tanggal_pengajuan']); ?></td>
                            <td><?= esc($aset['status_kerusakan']); ?></td>
                            <td>
                                <a href="<?= base_url('aset-rusak/detailpegawai/' . $aset['id'] . '/' .$aset['id_aset']); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada pengajuan aset rusak.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    /* General Table Styles */
    .table {
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    /* Status Badge Styles */
    .badge-status {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }

    .badge-status.pengajuan {
        background-color: #f1c40f;
    }

    .badge-status.proses {
        background-color: #e67e22;
    }

    .badge-status.selesai {
        background-color: #28a745;
    }

    /* Button Styles */
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 16px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background-color: #138496;
        color: white;
    }
    
</style>

<?= $this->endSection(); ?>
