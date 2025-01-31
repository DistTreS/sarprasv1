<h2>Detail Peserta Latsar</h2>
<table border="1">
    <tr>
        <th>Nama</th>
        <td><?= $peserta['Nama']; ?></td>
    </tr>
    <tr>
        <th>NIP</th>
        <td><?= $peserta['Nip']; ?></td>
    </tr>
    <tr>
        <th>Tempat & Tanggal Lahir</th>
        <td><?= $peserta['Tempat_Tgl_Lahir']; ?></td>
    </tr>
    <tr>
        <th>Golruang</th>
        <td><?= $peserta['Golruang']; ?></td>
    </tr>
    <tr>
        <th>Jabatan</th>
        <td><?= $peserta['nama_jabatan']; ?></td>
    </tr>
    <tr>
        <th>Instansi</th>
        <td><?= $peserta['instansi']; ?></td>
    </tr>
    <tr>
        <th>Angkatan</th>
        <td><?= $peserta['angkatan']; ?></td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td><?= $peserta['tahun']; ?></td>
    </tr>
    <tr>
        <th>Sertifikat</th>
        <td>
            <?php if ($peserta['sertifikat']): ?>
                <a href="<?= base_url('public/uploads/sertifikat/' . $peserta['sertifikat']); ?>" target="_blank">Lihat Sertifikat</a>
            <?php else: ?>
                Tidak Ada Sertifikat
            <?php endif; ?>
        </td>
    </tr>
</table>
<a href="<?= base_url('pesertaLatsar'); ?>">Kembali</a>