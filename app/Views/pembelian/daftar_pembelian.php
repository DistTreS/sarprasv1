<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

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
