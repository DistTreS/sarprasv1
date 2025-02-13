<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    /* Container styles */
    .container {
        max-width: 700px;
        margin: 40px auto;
        padding: 35px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Header styles */
    h2 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 35px;
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

    /* Form styles */
    form {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .mb-3 {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        font-size: 15px;
    }

    .form-control {
        padding: 12px 16px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background-color: #ffffff;
        outline: none;
    }

    /* Textarea specific styles */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
        line-height: 1.5;
    }

    /* Button container */
    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    /* Button styles */
    .btn {
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 500;
        letter-spacing: 0.3px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        flex: 1;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2);
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        box-shadow: 0 2px 4px rgba(108, 117, 125, 0.2);
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(108, 117, 125, 0.3);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-control {
            padding: 10px 14px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
        }
    }
</style>

<h2>Tambah Jenis Diklat</h2>

<form action="<?= base_url('diklat/simpanJenisDiklat'); ?>" method="post">
    <?= csrf_field(); ?>

    <div class="mb-3">
        <label for="nama_diklat" class="form-label">Nama Diklat</label>
        <input type="text" class="form-control" id="nama_diklat" name="nama_diklat" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('diklat'); ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>