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
        <h4>Bukti Pengembalian</h4>
        <img src="<?= base_url('uploads/bukti_pengembalian/' . esc($peminjaman['bukti_pengembalian'])) ?>"
            alt="Bukti Pengembalian"
            style="max-width:300px; display:block; margin-bottom: 15px;">
    <?php endif; ?>

    <h4>Daftar Aset yang Dikembalikan</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>NUP</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($aset_pinjaman)) : ?>
                <?php foreach ($aset_pinjaman as $aset) : ?>
                    <tr>
                        <td><?= esc($aset['nama_aset']) ?></td>
                        <td><?= esc($aset['nup']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">Tidak ada aset yang dikembalikan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>

    <!-- Tombol Setujui & Tolak (hanya jika masih dalam proses) -->
    <?php if ($peminjaman['status_layanan'] == 'Proses'): ?>
        <form action="<?= base_url('peminjaman/setujui/' . $peminjaman['id_pengajuan']) ?>" method="post" style="display:inline;">
            <button type="submit" class="btn btn-success">Setujui</button>
        </form>

        <form action="<?= base_url('peminjaman/tolak/' . $peminjaman['id_pengajuan']) ?>" method="post" style="display:inline;">
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
    <?php endif; ?>
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

    .table {
        width: 100%;
        border-collapse: collapse;
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
    .btn-success,
    .btn-danger {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background: #6c757d;
    }

    .btn-success {
        background: #28a745;
    }

    .btn-danger {
        background: #dc3545;
    }

    .btn-secondary:hover,
    .btn-success:hover,
    .btn-danger:hover {
        opacity: 0.8;
    }
</style>
<?= $this->endSection() ?>