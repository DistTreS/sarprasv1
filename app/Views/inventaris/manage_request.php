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

    .status-sent { color: orange; font-weight: bold; }
    .status-accepted { color: green; font-weight: bold; }
    .status-rejected { color: red; font-weight: bold; }

    select {
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>

<div class="container">
    <h2>Daftar Permintaan</h2>
    
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal Request</th>
            <th>Nama Peminta</th>
            <th>Barang</th>
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
                <td>
                    <?php 
                        $statusClass = '';
                        switch ($request['status']) {
                            case 'diproses': 
                                $statusClass = 'status-sent'; 
                                break;
                            case 'diterima': 
                                $statusClass = 'status-accepted'; 
                                break;
                            case 'ditolak': 
                                $statusClass = 'status-rejected'; 
                                break;
                        }
                    ?>
                    <span class="<?= $statusClass; ?>"> <?= htmlspecialchars($request['status']); ?> </span>
                </td>
                <td>
 
                <?php if ($statusClass === 'status-sent'): ?>
                    <button onclick="updateStatus(<?= $request['id_request']; ?>, 'diterima')" class="btn-accept">Terima</button>
                    <button onclick="updateStatus(<?= $request['id_request']; ?>, 'ditolak')" class="btn-reject">Tolak</button>
                <?php else: ?>
                    <span><?= htmlspecialchars($request['status']); ?></span>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

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