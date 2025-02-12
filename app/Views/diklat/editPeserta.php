<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Peserta Diklat</h2>
    <form action="<?= base_url('diklat/updatePeserta/' . esc($peserta['id_peserta_diklat'])) ?>" method="post">
        <input type="hidden" name="id_peserta" value="<?= esc($peserta['id_peserta']) ?>">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= esc($peserta['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" value="<?= esc($peserta['nip']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" value="<?= esc($peserta['tempat_lahir']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" value="<?= esc($peserta['tanggal_lahir']) ?>" required>
        </div>

        <div class="form-group">
            <label>Golongan / Ruang</label>
            <input type="text" class="form-control" name="golruang" value="<?= esc($peserta['golruang']) ?>" required>
        </div>

        <div class="form-group">
            <label>Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan" value="<?= esc($peserta['nama_jabatan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Instansi</label>
            <input type="text" class="form-control" name="instansi" value="<?= esc($peserta['instansi']) ?>" required>
        </div>

        <div class="form-group">
            <label>Angkatan</label>
            <input type="text" class="form-control" name="angkatan" value="<?= esc($peserta['angkatan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" value="<?= esc($peserta['tahun']) ?>" required>
        </div>

        <div class="form-group">
            <label>Sertifikat</label>
            <input type="text" class="form-control" name="sertifikat" value="<?= esc($peserta['sertifikat']) ?>">
        </div>

        <div class="form-group">
            <label>Judul Tugas Akhir</label>
            <input type="text" class="form-control" name="judul_tugas_akhir" value="<?= esc($peserta['judul_tugas_akhir']) ?>">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
<?= $this->endSection() ?>