<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>





<h2>Riwayat Transaksi</h2>

<style>
    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    label {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    input, select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        background: #007bff;
        color: white;
        font-weight: bold;
        border-radius: 5px;
    }

    button:hover {
        background: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .pagination a {
        padding: 8px 12px;
        margin: 0 5px;
        background: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }

    .pagination a:hover {
        background: #0056b3;
    }
</style>

<div class="container">
    <form method="GET">
        <label>Tanggal mulai: <input type="date" name="date_from" value="<?= $_GET['date_from'] ?? ''; ?>"></label>
        <label>Tanggal Selesai: <input type="date" name="date_to" value="<?= $_GET['date_to'] ?? ''; ?>"></label>
        <!-- <label>Tipe Transaksi:
            <select name="type">
                <option value="">All</option>
                <option value="in" <?= ($_GET['type'] ?? '') === 'in' ? 'selected' : ''; ?>>Masuk</option>
                <option value="out" <?= ($_GET['type'] ?? '') === 'out' ? 'selected' : ''; ?>>Keluar</option>
            </select>
        </label> -->
        <!-- <label>User: <input type="text" name="user" value="<?= $_GET['user'] ?? ''; ?>"></label> -->
        <button type="submit">Filter</button>
    </form>

    <table>
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
                    <td><?= htmlspecialchars($t['nama_barang']); ?></td>
                    <td><?= htmlspecialchars($t['nama_user']); ?></td>
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
