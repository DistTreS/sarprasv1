<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container" id="printArea">
    <h2>Detail Aset Rusak</h2>
    <div class="form-container">
        <div class="form-group">
            <label>Nama Pelapor:</label>
            <input type="text" class="form-control" value="<?= esc($asetRusak['nama_pelapor']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nama Aset:</label>
            <input type="text" class="form-control" value="<?= esc($asetRusak['nama_kategori']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Tanggal Pengajuan:</label>
            <input type="text" class="form-control" value="<?= esc($asetRusak['tanggal_pengajuan']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Keterangan:</label>
            <textarea class="form-control" readonly><?= esc($asetRusak['keterangan']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Status Kerusakan:</label>
            <span class="status <?= strtolower(str_replace(' ', '-', $asetRusak['status_rusak'])); ?>">
                <?= esc($asetRusak['status_rusak']); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Bukti Foto:</label>
            <div class="image-container">
                <?php if (!empty($asetRusak['bukti_foto'])): ?>
                    <?php foreach (explode(',', $asetRusak['bukti_foto']) as $foto): ?>
                        <img src="<?= base_url('uploads/aset_rusak/' . $foto); ?>" alt="Bukti Foto" class="bukti-foto">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada bukti foto</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="button-group">
            <a href="javascript:void(0);" class="btn-print" onclick="printContent()">Cetak</a>
            <a href="javascript:history.back()" class="btn-back">Kembali</a>
        </div>
    </div>
</div>

<script>
function printContent() {
    var printArea = document.getElementById('printArea').innerHTML;
    var originalBody = document.body.innerHTML;

    document.body.innerHTML = printArea;
    window.print();
    document.body.innerHTML = originalBody;
}
</script>

<style>
   .form-container {
        max-width: 800px;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #f9f9f9;
        height: 50px;
    }
    textarea.form-control {
        height: 100px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .btn-print {
        display: block;
        text-align: center;
        margin-top: 20px;
        padding: 10px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn-back {
        display: block;
        text-align: center;
        margin-top: 10px;
        padding: 10px;
        background: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .btn-back:hover {
        background: #5a6268;
    }
    .image-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .bukti-foto {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .btn-print, .btn-back {
            display: none;
        }
    }
</style>

<?= $this->endSection(); ?>
