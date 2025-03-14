<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .info {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Formulir Peminjaman Aset PPSDM Regional Bukittinggi</h2>
    </div>

    <div class="info">
        <div>
            <p><strong>Nama Peminjam:</strong> <?= esc($peminjaman['user_name']); ?></p>
            <p><strong>Nomor Telepon:</strong> <?= esc($peminjaman['no_telepon']); ?></p>
        </div>
        <div>
            <p><strong>Tanggal Peminjaman:</strong> <?= esc($peminjaman['tanggal_pengajuan']); ?></p>
            <p><strong>Tanggal Rencana Pengembalian:</strong> <?= esc($peminjaman['tanggal_rencana_pengembalian']); ?></p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID Aset</th>
                <th>Nama Aset</th>
                <th>CC</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= esc($peminjaman['id_aset']); ?></td>
                <td><?= esc($peminjaman['nama_kategori']); ?></td>
                <td><?= esc($peminjaman['cc']); ?></td>
                <td><?= esc($peminjaman['keterangan']); ?></td>
                <td>1 Unit</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Status Peminjaman:</strong> <?= esc($peminjaman['status_peminjaman']); ?></p>
    <p><strong>Status Pelayanan:</strong> <?= esc($peminjaman['status_layanan']); ?></p>

</body>
</html>
