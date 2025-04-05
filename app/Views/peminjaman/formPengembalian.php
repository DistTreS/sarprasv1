<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Form Pengembalian Aset</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/pegawai/peminjaman/uploadPengembalian/' . esc($peminjaman['id_pengajuan'])) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_pengajuan" value="<?= esc($peminjaman['id_pengajuan']) ?>">

        <label>Tanggal Pengembalian:</label>
        <input type="text" value="<?= date('Y-m-d H:i:s') ?>" disabled>

        <?php if (!empty($peminjaman['bukti_pengembalian'])): ?>
            <strong>Anda Sudah Upload Bukti Pengembalian!</strong>
        <?php else: ?>
            <div class="alert alert-danger mt-2" role="alert">
                <label>Bukti Pengembalian:</label>
                <input type="file" name="bukti_pengembalian" required>
            </div>
        <?php endif; ?>

        <button type="submit">Submit</button>
        <a href="<?= base_url('pegawai/peminjaman') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>


<style>
    .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    p {
        font-size: 14px;
        color: red;
    }

    label {
        font-weight: bold;
        display: block;
        margin: 15px 0 5px;
        text-align: left;
        font-size: 14px;
        color: #555;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    input[type="text"]:disabled {
        background: #f5f5f5;
        color: #888;
    }

    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #218838;
    }
</style>

<?= $this->endSection() ?>