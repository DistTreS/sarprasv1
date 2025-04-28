<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>



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

    /* CSS untuk form filter */
    form {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    select {
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    button[type="submit"] {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

<!-- <div class="container">
    <h2>Daftar Inventaris</h2> 
    <a href="<?= base_url('inventaris/create'); ?>" class="btn-primary">Tambah Item</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($persediaan as $index => $p): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($p['nama_barang']); ?></td>
                <td><?= htmlspecialchars($p['satuan']); ?></td>
                <td><?= htmlspecialchars($p['jumlah']); ?></td>
                <td>Terpakai</td>
                <td>Sisa</td>
                <td><?= htmlspecialchars($p['nilai']); ?></td>
                <td><?= htmlspecialchars($p['deskripsi']); ?></td>
                <td class="action-buttons">
                    <a href="<?= base_url('inventaris/edit/'.$p['id_barang']); ?>" class="btn-action btn-edit">Edit</a>
                    <a href="<?= base_url('inventaris/delete/'.$p['id_barang']); ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <a href="<?= base_url('inventaris/item_history/' . $p['id_barang']); ?>" class="btn-action btn-history">Riwayat</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div> -->


<div class="container">
    <h2>Daftar Inventaris</h2> 


    <form method="GET" action="<?= base_url('inventaris/cetak'); ?>" target="_blank" style="margin-bottom: 20px;">
    <label for="jenis">Jenis Barang:</label>
    <select name="jenis" id="jenis">
        <option value="">Semua</option>
        <option value="Persediaan" <?= ($_GET['jenis'] ?? '') == 'Persediaan' ? 'selected' : '' ?>>Persediaan</option>
        <option value="Habis Pakai" <?= ($_GET['jenis'] ?? '') == 'Habis Pakai' ? 'selected' : '' ?>>Habis Pakai</option>
    </select>
    <button type="submit">Cetak</button>
</form>

    <a href="<?= base_url('inventaris/create'); ?>" class="btn-primary">Tambah Item</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th>Nilai</th>
            <th>Jenis Barang</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($persediaan as $index => $p): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($p['nama_barang']); ?></td>
                <td><?= htmlspecialchars($p['satuan']); ?></td>
                <td><?= htmlspecialchars($p['jumlah'] ?? 0); ?></td> <!-- Total Inward Items -->
                <td><?= htmlspecialchars($p['pakai'] ?? 0); ?></td> <!-- Total Outward Items -->
                <td><?= htmlspecialchars($p['sisa'] ?? 0); ?></td> <!-- Remaining Items -->
                <td><?= htmlspecialchars($p['nilai'] ?? 0); ?></td>
                <td><?= htmlspecialchars($p['deskripsi'] ?? ''); ?></td>
                <td class="action-buttons">
                    <a href="<?= base_url('inventaris/edit/'.$p['id_barang']); ?>" class="btn-action btn-edit">Edit</a>
                    <a href="<?= base_url('inventaris/delete/'.$p['id_barang']); ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <a href="<?= base_url('inventaris/item_history/' . $p['id_barang']); ?>" class="btn-action btn-history">Riwayat</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<?= $this->endSection() ?>