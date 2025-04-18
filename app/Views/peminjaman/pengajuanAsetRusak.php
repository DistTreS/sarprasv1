<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2>Riwayat Pengajuan Aset Rusak</h2>

    <div class="mb-3">
        <a href="<?= base_url('aset-rusak/pengajuanadmin'); ?>" class="btn btn-primary"> Pengajuan Aset Rusak
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
                    <th>User</th>
                    <th>Nama Aset</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($asetRusakList)): ?>
                    <?php foreach ($asetRusakList as $aset): ?>
                        <tr>
                            <td>
                                <span class="badge badge-primary"><?= esc($aset['full_name']); ?></span>
                            </td>
                            <td><?= esc($aset['nama_kategori']); ?></td>
                            <td><?= esc($aset['tanggal_pengajuan']); ?></td>
                            <td>
                                <span class="badge-status <?= strtolower(str_replace(' ', '-', $aset['status_kerusakan'])); ?>">
                                    <?= esc($aset['status_kerusakan']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('aset-rusak/detail/' . $aset['id'] . '/' . $aset['id_aset']); ?>" class="btn btn-info btn-sm">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada pengajuan aset rusak.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    h2 {
        margin-bottom: 10px; 
        text-align: center;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }

    .rusak-ringan {
        background-color: #f1c40f;
    }

    /* Kuning */
    .rusak-sedang {
        background-color: #e67e22;
    }

    /* Oranye */
    .rusak-berat {
        background-color: #e74c3c;
    }

    /* Merah */

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

    .btn-info {
        display: inline-block;
        padding: 10px 10px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
    }
    
    .btn-primary {
        background-color:  #007bff;
        text-decoration: none;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
    }

    .btn-info:hover {
        background-color: #138496;
    }
</style>

<?= $this->endSection(); ?>