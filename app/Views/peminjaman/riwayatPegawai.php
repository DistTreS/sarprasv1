<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Riwayat Peminjaman</h2>
    
    <a href="<?= base_url('pegawai/peminjaman/ajukan'); ?>" class="btn btn-ajukan">Ajukan Peminjaman</a>
    
    <table>
        <tr>
            <th>NUP</th>
            <th>Nama Aset</th>
            <th>Tanggal Pengajuan</th>
            <th>Tanggal Rencana Pengembalian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($peminjaman as $item) : ?>
        <tr>
            <td><?= esc($item['nup']); ?></td>
            <td><?= esc($item['nama_aset']); ?></td>
            <td><?= esc($item['tanggal_peminjaman']); ?></td>
            <td><?= esc($item['tanggal_rencana_pengembalian']); ?></td>
            <td><span class="status <?= strtolower($item['status_layanan']); ?>"><?= esc($item['status_layanan']); ?></span></td>
            <td>
                <a href="<?= base_url('/pegawai/peminjaman/detail/' . $item['id_peminjaman']); ?>" class="btn btn-detail">Lihat Detail</a>
                <?php if ($item['status_layanan'] == 'Proses') : ?>
                    <a href="<?= base_url('/pegawai/peminjaman/pengembalian/' . $item['id_peminjaman']); ?>" class="btn btn-kembali">Pengembalian</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<style>
    .container {
        padding: 20px;
        max-width: 90%;
        margin: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .btn {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        transition: all 0.3s ease-in-out;
        margin: 2px;
    }
    .btn-ajukan {
        background: #17a2b8;
        color: white;
        display: inline-block;
        margin-bottom: 10px;
    }
    .btn-detail {
        background: #007bff;
        color: white;
    }
    .btn-kembali {
        background: #28a745;
        color: white;
    }
    .btn:hover {
        opacity: 0.8;
    }
    .status {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        text-transform: capitalize;
    }
    .status.proses {
        background: #ffc107;
        color: #212529;
    }
    .status.selesai {
        background: #28a745;
        color: white;
    }
</style>
<?= $this->endSection() ?>
