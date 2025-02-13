<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Daftar Permintaan</h2>

<table border="1">
    <tr>
        <th>No</th>
        <th>Tanggal Request</th>
        <th>Nama Peminta</th>
        <th>Items</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($requests as $index => $request): ?>
        <tr>
            <td><?= $index + 1; ?></td>
            <td><?= htmlspecialchars(date('d-m-Y', strtotime($request['tanggal_request']))); ?></td>
            <td><?= htmlspecialchars($request['nama_peminta']); ?></td>
            <td>
                <ul>
                <?php foreach ($request['details'] as $detail): ?>
                    <li>
                        <?= htmlspecialchars($detail['nama_barang']); ?> - 
                        <?= htmlspecialchars($detail['jumlah']); ?> units
                    </li>
                <?php endforeach; ?>
                </ul>
            </td>
            <td><?= htmlspecialchars($request['status']); ?></td>
            <td>
                <?php if($request['status'] === 'Sent'): ?>
                    <select onchange="updateStatus(<?= $request['id_request']; ?>, this.value)">
                        <option value="Sent" <?= $request['status'] === 'Sent' ? 'selected' : ''; ?>>Sent</option>
                        <option value="Processed" <?= $request['status'] === 'Processed' ? 'selected' : ''; ?>>Processed</option>
                        <option value="Accepted" <?= $request['status'] === 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                        <option value="Rejected" <?= $request['status'] === 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                <?php else: ?>
                    <?= htmlspecialchars($request['status']); ?>
                <?php endif; ?>
                |
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
function updateStatus(requestId, newStatus) {
    if (confirm('Apakah Anda yakin ingin memperbarui status request ini?')) {
        fetch('<?= base_url('inventaris/update_status/'); ?>' + requestId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server Response:', data);
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('Terjadi kesalahan saat memperbarui status');
        });
    }
}


</script>

<?= $this->endSection() ?>