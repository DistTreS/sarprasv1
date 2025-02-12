<?= $this->include('layout/sidebar'); ?>
<h2>Item History: <?= $item_name; ?></h2>

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
<?php endif; ?>
