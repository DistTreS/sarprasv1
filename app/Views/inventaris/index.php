<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Daftar Inventaris</h2> 
<a href="<?= base_url('inventaris/create'); ?>" class="btn btn-primary">Tambah Item</a>
<table border="1">
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
            <td><?= $index + 1; ?></td> <!-- Display sequential numbers -->
            <td><?= htmlspecialchars($p['nama_barang']); ?></td>
            <td><?= htmlspecialchars($p['satuan']); ?></td>
            <td><?= htmlspecialchars($p['jumlah']); ?></td>
            <td><?= htmlspecialchars($p['unknown_column1'] ?? ''); ?></td>
            <td><?= htmlspecialchars($p['unknown_column2'] ?? ''); ?></td>
            <td><?= htmlspecialchars($p['nilai']); ?></td>
            <td><?= htmlspecialchars($p['deskripsi']); ?></td>
            <td>
                <a href="<?= base_url('inventaris/edit/'.$p['id_barang']); ?>">Edit</a> |
                <a href="<?= base_url('inventaris/delete/'.$p['id_barang']); ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a> |
                <a href="<?= base_url('inventaris/item_history/' . $p['id_barang']); ?>">View History</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>