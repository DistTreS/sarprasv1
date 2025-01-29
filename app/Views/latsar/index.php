<?= $this->include('layout/sidebar'); ?>
<h2>Daftar Peserta Latsar</h2>
<a href="<?= base_url('pesertaLatsar/create'); ?>" class="btn btn-primary">Tambah Peserta</a>
<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIP</th>
        <th>Golruang</th>
        <th>Jabatan</th>
        <th>Instansi</th>
        <th>Angkatan</th>
        <th>Tahun</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($peserta as $p): ?>
        <tr>
            <td><?= $p['id_peserta_latsar']; ?></td>
            <td><?= $p['Nama']; ?></td>
            <td><?= $p['Nip']; ?></td>
            <td><?= $p['Golruang']; ?></td>
            <td><?= $p['nama_jabatan']; ?></td>
            <td><?= $p['instansi']; ?></td>
            <td><?= $p['angkatan']; ?></td>
            <td><?= $p['tahun']; ?></td>
            <td>
                <a href="<?= base_url('pesertaLatsar/view/'.$p['id_peserta_latsar']); ?>">View</a> |
                <a href="<?= base_url('pesertaLatsar/edit/'.$p['id_peserta_latsar']); ?>">Edit</a> |
                <a href="<?= base_url('pesertaLatsar/delete/'.$p['id_peserta_latsar']); ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
