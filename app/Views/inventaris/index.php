<?= $this->include('layout/sidebar'); ?>
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
    </tr>
    <?php foreach ($persediaan as $p): ?>
        <tr>
            <td><?= $p['id_barang']; ?></td>
            <td><?= $p['nama_barang']; ?></td>
            <td><?= $p['satuan']; ?></td>
            <td><?= $p['jumlah']; ?></td>
            <td><?= $p['unknown_column1'] ?? ''; ?></td>
            <td><?= $p['unknown_column2'] ?? ''; ?></td>
            <td><?= $p['nilai']; ?></td>
            <td><?= $p['deskripsi']; ?></td>
            <td>
                
                <a href="<?= base_url('inventaris/edit/'.$p['id_barang']); ?>">Edit</a> |
                <a href="<?= base_url('inventaris/delete/'.$p['id_barang']); ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
