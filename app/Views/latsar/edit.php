
    <h2>Edit Data Peserta Latsar</h2>
    <form action="<?= base_url('pesertaLatsar/update/' . $peserta['id_peserta_latsar']); ?>" method="post" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $peserta['Nama']; ?>" required><br>

        <label>NIP:</label>
        <input type="text" name="nip" value="<?= $peserta['Nip']; ?>" required><br>

        <label>Tempat & Tanggal Lahir:</label>
        <input type="text" name="tempat_tgl_lahir" value="<?= $peserta['Tempat_Tgl_Lahir']; ?>" required><br>

        <label>Golruang:</label>
        <input type="text" name="golruang" value="<?= $peserta['Golruang']; ?>" required><br>

        <label>Jabatan:</label>
        <input type="text" name="nama_jabatan" value="<?= $peserta['nama_jabatan']; ?>" required><br>

        <label>Instansi:</label>
        <input type="text" name="instansi" value="<?= $peserta['instansi']; ?>" required><br>

        <label>Angkatan:</label>
        <input type="text" name="angkatan" value="<?= $peserta['angkatan']; ?>" required><br>

        <label>Tahun:</label>
        <input type="text" name="tahun" value="<?= $peserta['tahun']; ?>" required><br>

        <label>Sertifikat (PDF):</label>
        <input type="file" name="sertifikat"><br>
        <?php if ($peserta['sertifikat']): ?>
            <p>Sertifikat Saat Ini: <a href="<?= base_url('public/uploads/sertifikat/' . $peserta['sertifikat']); ?>" target="_blank">Lihat</a></p>
        <?php endif; ?>

        <button type="submit">Simpan Perubahan</button>
        <a href="<?= base_url('pesertaLatsar'); ?>">Batal</a>
    </form>
