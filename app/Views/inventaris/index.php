<?= $this->include('layout/sidebar'); ?>
<h2>Daftar Inventaris</h2> 
<a href="<?= base_url('pesertaLatsar/create'); ?>" class="btn btn-primary">Tambah Item</a>
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
            <td><?= $p['#']; ?></td>
            <td><?= $p['#']; ?></td>
            <td><?= $p['nilai']; ?></td>
            <td><?= $p['deskripsi']; ?></td>
            <td>
                <a href="<?= base_url('pesertaLatsar/view/'.$p['id_peserta_latsar']); ?>">View</a> |
                <a href="<?= base_url('pesertaLatsar/edit/'.$p['id_peserta_latsar']); ?>">Edit</a> |
                <a href="<?= base_url('pesertaLatsar/delete/'.$p['id_peserta_latsar']); ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
