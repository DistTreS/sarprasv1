<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h2>Laporan Transaksi</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Nama User</th>
            <th>Tipe Transaksi</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $i => $t): ?>
        <tr>
            <td><?= $i + 1; ?></td>
            <td><?= $t['nama_barang']; ?></td>
            <td><?= $t['full_name']; ?></td>
            <td><?= $t['tipe_transaksi']; ?></td>
            <td><?= $t['jumlah']; ?></td>
            <td><?= $t['tanggal_transaksi']; ?></td>
            <td><?= $t['keterangan']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
