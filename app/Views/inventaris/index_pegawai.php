<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>

<h2>Daftar Inventaris</h2> 
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Terpakai</th>
        <th>Sisa</th>
        <th>Nilai</th>
        <th>Keterangan</th>
    </tr>
    <?php foreach ($persediaan as $index => $p): ?>
        <tr>
            <td><?= $index + 1; ?></td> <!-- Display sequential numbers -->
            <td><?= htmlspecialchars($p['nama_barang']); ?></td>
            <td><?= htmlspecialchars($p['satuan']); ?></td>
            <td><?= htmlspecialchars($p['jumlah']); ?></td>
            <td><?= htmlspecialchars($p['unknown_column1'] ?? ''); ?></td>
            <td><?= htmlspecialchars($p['unknown_column2'] ?? ''); ?></td>
            <td><?= htmlspecialchars($p['nilai']); ?></td>
            <td><?= htmlspecialchars($p['deskripsi']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<style>
    .container {
        max-width: 100%;
        padding: 20px;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    .btn-primary {
        display: inline-block;
        margin-bottom: 15px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .btn-action {
        padding: 6px 10px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        transition: 0.3s;
    }

    .btn-edit {
        background-color: #28a745;
        color: white;
    }

    .btn-edit:hover {
        background-color: #218838;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-history {
        background-color: #ffc107;
        color: black;
    }

    .btn-history:hover {
        background-color: #e0a800;
    }
</style>

<?= $this->endSection() ?>