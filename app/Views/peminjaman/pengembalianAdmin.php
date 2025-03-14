<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Detail Pengembalian (Admin)</h2>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <table class="table">
        <tr>
            <th>Nama Pegawai</th>
            <td><?= esc($peminjaman['nama_pegawai'] ?? 'Tidak ada data') ?></td>
        </tr>
        <tr>
            <th>Nama Aset</th>
            <td><?= esc($peminjaman['nama_aset'] ?? 'Tidak ada data') ?></td>
        </tr>
        <tr>
            <th>Tanggal Pengembalian</th>
            <td><?= esc($peminjaman['tanggal_pengembalian'] ?? 'Tidak ada data') ?></td>
        </tr>
        <tr>
            <th>Bukti Pengembalian</th>
            <td>
                <?php if (!empty($peminjaman['bukti_pengembalian'])) : ?>
                    <img src="<?= base_url('uploads/bukti_pengembalian/' . esc($peminjaman['bukti_pengembalian'])) ?>" 
                         alt="Bukti Pengembalian" 
                         style="max-width:300px; display:block;">
                <?php else : ?>
                    <p>Tidak ada bukti</p>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>

    <!-- Tombol Setujui & Tolak (hanya jika ada bukti pengembalian) -->
    <?php if ($peminjaman['status_layanan'] == 'Proses'): ?>
        <form action="<?= base_url('peminjaman/setujui/' . $peminjaman['id_peminjaman']) ?>" method="post" style="display:inline;">
            <button type="submit" class="btn btn-success">Setujui</button>
        </form>

        <form action="<?= base_url('peminjaman/tolak/' . $peminjaman['id_peminjaman']) ?>" method="post" style="display:inline;">
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
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    .btn-secondary, .btn-success, .btn-danger {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
    .btn-secondary { background: #6c757d; }
    .btn-success { background: #28a745; }
    .btn-danger { background: #dc3545; }
    .btn-secondary:hover, .btn-success:hover, .btn-danger:hover {
        opacity: 0.8;
    }
</style>
<?= $this->endSection() ?>
