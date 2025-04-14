<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Daftar Inventaris</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Daftar Inventaris</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Terpakai</th>
                <th>Sisa</th>
                <th>Nilai</th>
                <th>Jenis Barang</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($persediaan)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data</td></tr>
            <?php else: ?>
                <?php foreach ($persediaan as $index => $p): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($p['nama_barang']) ?></td>
                        <td><?= esc($p['satuan']) ?></td>
                        <td><?= esc($p['jumlah'] ?? 0) ?></td>
                        <td><?= esc($p['pakai'] ?? 0) ?></td>
                        <td><?= esc($p['sisa'] ?? 0) ?></td>
                        <td><?= esc($p['nilai'] ?? 0) ?></td>
                        <td><?= esc($p['deskripsi'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
