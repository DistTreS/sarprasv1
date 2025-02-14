<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Ajukan Peminjaman</h2>

    <form action="<?= base_url('pegawai/peminjaman/simpan') ?>" method="post">
        <label for="tanggal_pengajuan">Tanggal Pengajuan:</label>
        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" required>

        <label for="tanggal_rencana_pengembalian">Tanggal Rencana Pengembalian:</label>
        <input type="date" name="tanggal_rencana_pengembalian" id="tanggal_rencana_pengembalian" required>

        <label for="id_aset">Pilih Aset:</label>
        <select name="id_aset" id="id_aset" required>
            <option value="">-- Pilih Aset --</option>
            <?php foreach ($aset as $item) : ?>
                <option value="<?= esc($item['id_aset']); ?>">
                    <?= esc($item['nama_kategori']); ?> (ID: <?= esc($item['id_aset']); ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="cc">CC (Carbon Copy):</label>
        <input type="text" name="cc" id="cc" placeholder="Masukkan email CC (opsional)">

        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" id="keterangan" rows="4" placeholder="Tambahkan keterangan peminjaman"></textarea>

        <button type="submit">Ajukan Peminjaman</button>
    </form>
</div>

<style>
    .container {
        padding: 20px;
        max-width: 600px;
        margin: auto;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    select, input {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button {
        background: #007bff;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
    }
    button:hover {
        background: #0056b3;
    }
</style>
<?= $this->endSection() ?>
