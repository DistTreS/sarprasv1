<form action="<?= site_url('pesertaLatsar/store'); ?>" method="post" enctype="multipart/form-data">
    <label>Nama:</label>
    <input type="text" name="nama" required>

    <label>NIP:</label>
    <input type="text" name="nip" required>

    <label>Tempat & Tanggal Lahir:</label>
    <input type="text" name="tempat_tgl_lahir" required>

    <label>Golongan/Ruang:</label>
    <input type="text" name="golruang" required>

    <label>Jabatan:</label>
    <input type="text" name="nama_jabatan" required>

    <label>Instansi:</label>
    <input type="text" name="instansi" required>

    <label>Angkatan:</label>
    <input type="text" name="angkatan" required>

    <label>Tahun:</label>
    <input type="text" name="tahun" required>

    <label>Sertifikat (PDF):</label>
    <input type="file" name="sertifikat" accept=".pdf">

    <button type="submit">Simpan</button>
</form>

<form action="<?= base_url('pesertaLatsar/importExcel'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xlsx" required>
    <button type="submit">Import Excel</button>
</form>