<?= $this->include('layout/sidebar'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Requests</title>
    <script>
        function toggleItems(id) {
            var div = document.getElementById(id);
            div.style.display = div.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>
    <h2>Manage Requests</h2>
    
    <table border="1">
        <tr>
            <th>#</th>
            <th>Requester</th>
            <th>Date</th>
            <th>Status</th>
            <th>Items</th>
            <th>Action</th>
        </tr>
        <?php $index = 1; ?>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= $index++; ?></td>
                <td><?= esc($request['nama_peminta']); ?></td>
                <td><?= esc($request['tanggal_request']); ?></td>
                <td><?= esc($request['status']); ?></td>
                <td>
                    <button onclick="toggleItems('items-<?= $index; ?>')">View Items</button>
                    <div id="items-<?= $index; ?>" style="display: none;">
                        <ul>
                            <?php foreach ($request['items'] as $item): ?>
                                <li><?= esc($item['nama_barang']); ?> (<?= $item['jumlah']; ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </td>
                <td>
                    <form method="post" action="<?= base_url('inventaris/update_request_status/' . $request['id']); ?>">
                        <select name="status">
                            <option value="Sent" <?= $request['status'] === 'Sent' ? 'selected' : ''; ?>>Sent</option>
                            <option value="Processed" <?= $request['status'] === 'Processed' ? 'selected' : ''; ?>>Processed</option>
                            <option value="Accepted" <?= $request['status'] === 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                            <option value="Rejected" <?= $request['status'] === 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
