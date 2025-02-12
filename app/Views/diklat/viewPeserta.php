<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Detail Peserta Diklat</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td><?= esc($peserta['nama'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>NIP</th>
            <td><?= esc($peserta['nip'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td><?= esc($peserta['tempat_lahir'] ?? '-') ?>, <?= esc($peserta['tanggal_lahir'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Golongan/Ruang</th>
            <td><?= esc($peserta['golruang'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Nama Jabatan</th>
            <td><?= esc($peserta['nama_jabatan'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Instansi</th>
            <td><?= esc($peserta['instansi'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Angkatan</th>
            <td><?= esc($peserta_diklat['angkatan'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td><?= esc($peserta_diklat['tahun'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Sertifikat</th>
            <td>
                <?php if (!empty($peserta_diklat['sertifikat'])) : ?>
                    <a href="<?= base_url('uploads/sertifikat/' . $peserta_diklat['sertifikat']) ?>" class="btn btn-primary" download>
                        Download Sertifikat
                    </a>
                <?php else : ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Judul Tugas Akhir</th>
            <td><?= esc($peserta_diklat['judul_tugas_akhir'] ?? '-') ?></td>
        </tr>
    </table>
    <a href="<?= base_url('diklat') ?>" class="btn btn-secondary">Kembali</a>
</div>
<?= $this->endSection() ?>