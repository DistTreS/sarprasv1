<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Peserta Diklat</h2>
    <form action="<?= base_url('diklat/update/' . $peserta->id_peserta_diklat) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= esc($peserta->nama) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" value="<?= esc($peserta->nip) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tempat, Tanggal Lahir</label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" name="tempat_lahir" value="<?= esc($peserta->tempat_lahir) ?>" required>
                <input type="date" class="form-control" name="tanggal_lahir" value="<?= esc($peserta->tanggal_lahir) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" name="nama_jabatan" value="<?= esc($peserta->nama_jabatan) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Instansi</label>
            <input type="text" class="form-control" name="instansi" value="<?= esc($peserta->instansi) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="text" class="form-control" name="angkatan" value="<?= esc($peserta->angkatan) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun</label>
            <input type="number" class="form-control" name="tahun" value="<?= esc($peserta->tahun) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sertifikat</label>
            <input type="text" class="form-control" name="sertifikat" value="<?= esc($peserta->sertifikat) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Tugas Akhir</label>
            <input type="text" class="form-control" name="judul_tugas_akhir" value="<?= esc($peserta->judul_tugas_akhir) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Diklat</label>
            <select name="id_diklat" class="form-control" required>
                <?php foreach ($jenis_diklat as $diklat) : ?>
                    <option value="<?= $diklat->id_diklat ?>" <?= $peserta->id_diklat == $diklat->id_diklat ? 'selected' : '' ?>>
                        <?= esc($diklat->nama_diklat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('diklat') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>