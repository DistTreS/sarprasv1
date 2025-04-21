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

    .status-sent {
        color: orange;
        font-weight: bold;
    }

    .status-accepted {
        color: green;
        font-weight: bold;
    }

    .status-rejected {
        color: red;
        font-weight: bold;
    }

    button {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        margin-right: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-accept {
        background-color: #28a745;
        color: white;
    }

    .btn-reject {
        background-color: #dc3545;
        color: white;
    }

    button:hover {
        opacity: 0.9;
    }
</style>

<div class="container">
    <h2>Daftar Permintaan Pembelian</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Request</th>
                <th>Nama Peminta</th>
                <th>Barang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $index => $request): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= date('d-m-Y', strtotime($request['tanggal_request'])); ?></td>
                    <td><?= $request['nama_peminta']; ?></td>
                    <td>
                        <ul>
                            <?php foreach ($request['details'] as $detail): ?>
                                <li><?= $detail['nama_barang']; ?> - <?= $detail['jumlah']; ?> unit</li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <?php
                            $status = $request['status'];
                            $class = $status == 'diproses' ? 'status-sent' : ($status == 'diterima' ? 'status-accepted' : 'status-rejected');
                        ?>
                        <span class="<?= $class; ?>"><?= $status; ?></span>
                    </td>
                    <td>
                        <?php if ($status === 'diproses'): ?>
                            <button onclick="updateStatus(<?= $request['id_request']; ?>, 'diterima')">Terima</button>
                            <button onclick="updateStatus(<?= $request['id_request']; ?>, 'ditolak')">Tolak</button>
                        <?php else: ?>
                            <span><?= ucfirst($status); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function updateStatus(requestId, newStatus) {
    if (confirm('Yakin ingin mengubah status?')) {
        fetch('<?= base_url('pembelian/update_status/'); ?>' + requestId, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams({status: newStatus})
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        })
        .catch(err => alert('Terjadi kesalahan!'));
    }
}
</script>

<?= $this->endSection() ?>
