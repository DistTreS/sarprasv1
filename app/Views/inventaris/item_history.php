<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- <h2>Item History: <?= $item_name; ?></h2>

<table border="1">
    <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Tipe Transaksi</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
    </tr>
    <?php if (!empty($history)): ?>
        <?php foreach ($history as $index => $h): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= $h['id_barang']; ?></td>
                <td><?= $h['tipe_transaksi']; ?></td>
                <td><?= $h['jumlah']; ?></td>
                <td><?= $h['tanggal_transaksi']; ?></td>
                <td><?= $h['keterangan']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">No history found for this item.</td></tr>
    <?php endif; ?>
</table>

<?php if ($pager['total_pages'] > 1): ?>
    <div>
        <?php if ($pager['current_page'] > 1): ?>
            <a href="?page=<?= $pager['current_page'] - 1; ?>">Previous</a>
        <?php endif; ?>
        Page <?= $pager['current_page']; ?> of <?= $pager['total_pages']; ?>
        <?php if ($pager['current_page'] < $pager['total_pages']): ?>
            <a href="?page=<?= $pager['current_page'] + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
<?php endif; ?> -->

<h2>Item History: <?= htmlspecialchars($item_name); ?></h2>

<style>
    .container {
        max-width: 100%;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
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

    .no-history {
        text-align: center;
        font-style: italic;
        padding: 15px;
        color: #888;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        display: inline-block;
        padding: 8px 15px;
        margin: 0 5px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: 0.3s;
    }

    .pagination a:hover {
        background: #0056b3;
    }
</style>

<div class="container">
    <table>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tipe Transaksi</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
        <?php if (!empty($history)): ?>
            <?php foreach ($history as $index => $h): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($h['id_barang']); ?></td>
                    <td><?= htmlspecialchars($h['tipe_transaksi']); ?></td>
                    <td><?= htmlspecialchars($h['jumlah']); ?></td>
                    <td><?= htmlspecialchars($h['tanggal_transaksi']); ?></td>
                    <td><?= htmlspecialchars($h['keterangan']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-history">No history found for this item.</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if ($pager['total_pages'] > 1): ?>
        <div class="pagination">
            <?php if ($pager['current_page'] > 1): ?>
                <a href="?page=<?= $pager['current_page'] - 1; ?>">Previous</a>
            <?php endif; ?>
            Page <?= $pager['current_page']; ?> of <?= $pager['total_pages']; ?>
            <?php if ($pager['current_page'] < $pager['total_pages']): ?>
                <a href="?page=<?= $pager['current_page'] + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>


<?= $this->endSection() ?>
