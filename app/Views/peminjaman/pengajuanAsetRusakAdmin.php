<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="title">Pengajuan Aset Rusak</h2>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger fade-in"> <?= session()->getFlashdata('error'); ?> </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success fade-in"> <?= session()->getFlashdata('success'); ?> </div>
    <?php endif; ?>

    <form action="<?= base_url('aset-rusak/simpanadmin'); ?>" method="post" enctype="multipart/form-data" class="form-container">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="id_aset" class="form-label">Pilih Aset</label>
            <select class="form-control" id="id_aset" name="id_aset" required>
                <option value="">-- Pilih Aset --</option>
                <?php foreach ($asetList as $aset): ?>
                    <option value="<?= esc($aset['id_aset']); ?>">
                        <?= esc($aset['nama_kategori']) . ' - ' . esc($aset['nama_aset'] . ' - ' . esc($aset['nup'])); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
            <input type="text" class="form-control" id="tanggal_pengajuan" value="<?= date('Y-m-d') ?>" readonly>
        </div>


        <div class="mb-3">
            <label for="status_kerusakan" class="form-label">Tingkat Kerusakan</label>
            <select class="form-control" id="status_kerusakan" name="status_kerusakan" required>
                <option value="">-- Pilih Tingkat Kerusakan --</option>
                <option value="Rusak Ringan">Rusak Ringan</option>
                <option value="Rusak Sedang">Rusak Sedang</option>
                <option value="Rusak Berat">Rusak Berat</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="bukti_foto" class="form-label">Unggah Bukti Foto</label>
            <input type="file" class="form-control" id="bukti_foto" name="bukti_foto" accept="image/png, image/jpeg, image/jpg" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
    </form>

    <!-- 🔹 Tombol Kembali -->
    <a href="<?= base_url('aset_rusak'); ?>" class="btn btn-secondary kembali">Kembali</a>
</div>

<style>
    /* Base Styles */
    body {
        background: #f4f6f9;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    /* Container Styling */
    .container {
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        max-width: 700px;
    }

    /* Title Styling */
    .title {
        text-align: center;
        font-weight: 600;
        margin-bottom: 30px;
        color: #2c3e50;
        font-size: 28px;
        position: relative;
        padding-bottom: 15px;
    }

    .title:after {
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

    /* Form Elements Styling */
    .form-container {
        margin-top: 25px;
    }

    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1.5px solid #e1e8ef;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background: #ffffff;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Button Styling */
    .btn {
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        display: block;
        width: 100%;
        padding: 14px;
        border-radius: 5px;
        font-size: 16px;
        background: #007bff;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
            display: block;
            text-align: center;
            background-color: #6c757d;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s ease;
            margin-top: 10px;
        }

    .btn-secondary:hover {
        background: #545b62;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Alert Styling */
    .alert {
        padding: 16px;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
        border: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

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

    /* File Input Styling */
    input[type="file"] {
        padding: 10px;
        background: #f8fafc;
        border: 2px dashed #e1e8ef;
        cursor: pointer;
    }

    input[type="file"]:hover {
        border-color: #007bff;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px 15px;
        }

        .title {
            font-size: 24px;
        }
    }
</style>

<?= $this->endSection(); ?>