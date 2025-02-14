<?= $this->extend('layout/mainpegawai'); ?>

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
    
    <form action="<?= base_url('aset-rusak/simpan'); ?>" method="post" enctype="multipart/form-data" class="form-container">
        <?= csrf_field(); ?>
        
        <div class="mb-3">
            <label for="id_aset" class="form-label">Pilih Aset</label>
            <select class="form-control" id="id_aset" name="id_aset" required>
                <option value="">-- Pilih Aset --</option>
                <?php foreach ($asetList as $aset): ?>
                    <option value="<?= esc($aset['id_aset']); ?>">
                        <?= esc($aset['nama_kategori']) . ' - ' . esc($aset['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
            <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" required>
        </div>
        
        <div class="mb-3">
            <label for="status_rusak" class="form-label">Tingkat Kerusakan</label>
            <select class="form-control" id="status_rusak" name="status_rusak" required>
                <option value="">-- Pilih Tingkat Kerusakan --</option>
                <option value="rusak kecil">Rusak Kecil</option>
                <option value="rusak sedang">Rusak Sedang</option>
                <option value="rusak besar">Rusak Besar</option>
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
    <a href="<?= base_url('aset-rusak/riwayat'); ?>" class="btn btn-secondary kembali">Kembali</a>
</div>

<style>
    body {
        background: #f4f6f9;
        font-family: 'Poppins', sans-serif;
    }
    .container {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .title {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .btn-primary {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        background: #007bff;
        border: none;
        transition: background 0.3s;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    .btn-secondary {
        display: block;
        width: 100%;
        padding: 12px;
        text-align: center;
        border-radius: 8px;
        font-size: 16px;
        margin-top: 10px;
        background: #6c757d;
        border: none;
        color: #fff;
        text-decoration: none;
    }
    .btn-secondary:hover {
        background: #545b62;
    }
    .form-control {
        border-radius: 6px;
        padding: 10px;
    }
    .alert {
        padding: 15px;
        border-radius: 6px;
        font-size: 14px;
    }
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<?= $this->endSection(); ?>
