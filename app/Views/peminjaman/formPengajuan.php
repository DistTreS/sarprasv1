<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Ajukan Peminjaman</h2>

    <form action="<?= base_url('pegawai/peminjaman/simpan') ?>" method="post">
        <label for="tanggal_pengajuan">Tanggal Pengajuan:</label>
        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" required>

        <label for="tanggal_rencana_pengembalian">Tanggal Rencana Pengembalian:</label>
        <input type="date" name="tanggal_rencana_pengembalian" id="tanggal_rencana_pengembalian" required>

        <label for="aset">Pilih Aset:</label>
        <select name="aset" id="aset" required>
            <option value="">-- Pilih Aset --</option>
            <?php foreach ($asetList as $aset): ?>
                <option value="<?= esc($aset['id_aset']); ?>">
                    <?= esc($aset['nama_aset'] . ' (NUP: ' . $aset['nup'] . ')'); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="CC">CC (Carbon Copy):</label>
        <input type="text" name="CC" id="CC" placeholder="Masukkan email CC (opsional)">

        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" id="keterangan" rows="4" placeholder="Tambahkan keterangan peminjaman"></textarea>

        <div class="button-group">
            <button type="button" onclick="history.back()" class="btn-back">Kembali</button>
            <button type="submit">Ajukan Peminjaman</button>
        </div>
    </form>
</div>

<style>
    /* Container Styling */
    .container {
        padding: 40px;
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* Heading Styles */
    h2 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
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
        background: #007bff;
        border-radius: 2px;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 25px;
    }

    /* Label Styling */
    label {
        display: block;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 15px;
    }

    /* Input Fields Styling */
    input[type="date"],
    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #e1e8ef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    /* Select Specific Styling */
    select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    /* Textarea Specific Styling */
    textarea {
        min-height: 120px;
        resize: vertical;
    }

    /* Focus States */
    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background: #ffffff;
    }

    /* Button Styling */
    button {
        background: #007bff;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
        margin-top: 10px;
    }

    button:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    /* Placeholder Styling */
    ::placeholder {
        color: #a0aec0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px 15px;
        }

        h2 {
            font-size: 24px;
        }

        input[type="date"],
        input[type="text"],
        select,
        textarea {
            font-size: 16px; /* Better for mobile */
        }
    }

    /* Optional Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    form {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>
<?= $this->endSection() ?>
