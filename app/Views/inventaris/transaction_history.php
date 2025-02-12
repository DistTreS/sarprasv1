<?= $this->include('layout/sidebar'); ?>
<h2>Riwayat Transaksi</h2>

<form method="GET">
    <label>Tanggal mulai: <input type="date" name="date_from" value="<?= $_GET['date_from'] ?? ''; ?>"></label>
    <label>Tanggal Selesai: <input type="date" name="date_to" value="<?= $_GET['date_to'] ?? ''; ?>"></label>
    <label>Tipe Transaksi:
        <select name="type">
            <option value="">All</option>
            <option value="in" <?= ($_GET['type'] ?? '') === 'in' ? 'selected' : ''; ?>>Masuk</option>
            <option value="out" <?= ($_GET['type'] ?? '') === 'out' ? 'selected' : ''; ?>>Keluar</option>
        </select>
    </label>
    <label>User: <input type="text" name="user" value="<?= $_GET['user'] ?? ''; ?>"></label>
    <button type="submit">Filter</button>
</form>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Nama User</th>
        <th>Peminta</th>
        <th>Tipe Transaksi</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
    </tr>
    <?php if (!empty($transactions)): ?>
        <?php foreach ($transactions as $index => $t): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($t['nama_barang']); ?></td> <!-- Show nama_barang instead of id_barang -->
                <td><?= htmlspecialchars($t['nama_user']); ?></td> <!-- Show nama_user instead of id_user -->
                <td><?= htmlspecialchars($t['nama_peminta']); ?></td>
                <td><?= htmlspecialchars($t['tipe_transaksi']); ?></td>
                <td><?= htmlspecialchars($t['jumlah']); ?></td>
                <td><?= htmlspecialchars($t['tanggal_transaksi']); ?></td>
                <td><?= htmlspecialchars($t['keterangan']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">No transactions found.</td></tr>
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
