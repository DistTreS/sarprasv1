<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* Form Container */
    .container.mt-4 {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Header */
    h2 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #007bff;
        border-radius: 2px;
    }

    /* Form Layout */
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    /* Form Labels */
    label {
        font-weight: 500;
        color: #495057;
        font-size: 14px;
        flex: 1;
        /* Lebar label 1/3 dari form group */
        max-width: 250px;
    }

    /* Input Fields */
    .form-control {
        flex: 2;
        /* Lebar input 2/3 dari form group */
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 14px;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background-color: #ffffff;
    }

    /* Submit Button */
    .btn-success {
        margin-top: 20px;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 500;
        background-color: #28a745;
        border: none;
        border-radius: 6px;
        width: 100%;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.3);
        background-color: #218838;
    }
</style>

<div class="container mt-4">
    <h2>Edit Peserta Diklat</h2>
    <form action="<?= base_url('diklat/updatePeserta/' . esc($peserta['id_peserta']) . '/' . esc($id_diklat)) ?>" method="post" enctype="multipart/form-data">
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
            <?php if (!empty($peserta['sertifikat'])) : ?>
                <p>File saat ini: <a href="<?= base_url('uploads/sertifikat/' . $peserta['sertifikat']) ?>" download><?= esc($peserta['sertifikat']) ?></a></p>
            <?php endif; ?>
            <input type="file" class="form-control" name="sertifikat">
        </div>


        <div class="form-group">
            <label>Judul Tugas Akhir</label>
            <input type="text" class="form-control" name="judul_tugas_akhir" value="<?= esc($peserta['judul_tugas_akhir']) ?>">
        </div>

        <div class="form-group">
            <label>File Tugas Akhir</label>
            <?php if (!empty($peserta['tugas_akhir'])) : ?>
                <p>File saat ini: <a href="<?= base_url('uploads/tugas_akhir/' . $peserta['tugas_akhir']) ?>" download><?= esc($peserta['tugas_akhir']) ?></a></p>
            <?php endif; ?>
            <input type="file" class="form-control" name="tugas_akhir">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
<?= $this->endSection() ?>