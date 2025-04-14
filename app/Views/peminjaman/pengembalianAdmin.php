<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Detail Pengembalian</h2>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <p><strong>Nama Pegawai:</strong> <?= esc($peminjaman['nama_pegawai'] ?? 'Tidak ada data') ?></p>
    <p><strong>Tanggal Pengembalian:</strong> <?= esc($peminjaman['tanggal_pengembalian'] ?? 'Tidak ada data') ?></p>

    <?php if (!empty($peminjaman['bukti_pengembalian'])) : ?>
        <h4>Bukti Pengembalian:</h4>
        <img src="<?= base_url('uploads/bukti_pengembalian/' . esc($peminjaman['bukti_pengembalian'])) ?>"
            alt="Bukti Pengembalian"
            style="max-width:300px; display:block; margin-bottom: 15px;">
    <?php endif; ?>

    <h4>Daftar Aset yang Dikembalikan:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>NUP</th>
                <th>Nama Aset</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($aset_pinjaman)) : ?>
                <?php foreach ($aset_pinjaman as $aset) : ?>
                    <tr>
                        <td><?= esc($aset['nup']) ?></td>
                        <td><?= esc($aset['nama_aset']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">Tidak ada aset yang dikembalikan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($peminjaman['status_layanan'] == 'Proses'): ?>
    <div class="action-box">
        <form action="<?= base_url('peminjaman/setujui/' . $peminjaman['id_pengajuan']) ?>" method="post">
            <button type="submit" class="btn-approve">Setujui</button>
        </form>

        <form action="<?= base_url('peminjaman/tolak/' . $peminjaman['id_pengajuan']) ?>" method="post">
            <button type="submit" class="btn-reject">Tolak</button>
        </form>
    </div>
<?php endif; ?>


    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>
</div>




<style>
    .container {
        padding: 20px;
        max-width: 600px;
        margin: auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2{
        text-align: center;
    }

    h4{
        margin-bottom: 5PX;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
        margin-bottom: auto;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary,
   /* Kotak pembungkus tombol */
    .action-box {
        border: 2px solid #ccc;
        padding: 20px;
        border-radius: 12px;
        background-color: #f9f9f9;
        max-width: 500px;
        margin: 30px auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Styling tombol */
    .action-box form {
        margin-bottom: 15px;
    }

    .btn-approve,
    .btn-reject {
        width: 100%;
        padding: 14px;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Tombol Setujui (Hijau) */
    .btn-approve {
        background-color: #28a745;
    }

    .btn-approve:hover {
        background-color: #218838;
    }

    /* Tombol Tolak (Merah) */
    .btn-reject {
        background-color: #dc3545;
    }

    .btn-reject:hover {
        background-color: #c82333;
    }

    .btn-secondary {
            display: block;
            text-align: center;
            background-color: #6c757d;
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s ease;
            margin-top: 10px;
        }


    .btn-secondary:hover,
</style>
<?= $this->endSection() ?>