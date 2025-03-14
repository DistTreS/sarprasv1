<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container" id="printArea">
    <h2 class="page-title">Detail Pengajuan Aset Rusak</h2>
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
            <?php 
                $status = strtolower($asetRusak['status_kerusakan']);
                

                if ($status === 'rusak ringan') {
                    $statusColor = 'green';
                } elseif ($status === 'rusak sedang') {
                    $statusColor = 'orange';
                } elseif ($status === 'rusak berat') {
                    $statusColor = 'red';
                }
            ?>
            <span class="status" style="background: <?= $statusColor ?>; color: white; padding: 8px 15px; border-radius: 5px; font-weight: bold;">
                <?= esc($asetRusak['status_kerusakan']); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Bukti Foto:</label>
            <div class="image-container">
                <?php if (!empty($asetRusak['bukti_foto'])): ?>
                    <?php foreach (explode(',', $asetRusak['bukti_foto']) as $foto): ?>
                        <img src="<?= base_url('uploads/aset_rusak/' . esc($foto)); ?>" alt="Bukti Foto" class="bukti-foto">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada bukti foto</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="button-group">
            <a href="javascript:void(0);" class="btn btn-primary btn-print" onclick="printContent()">Cetak</a>
            <a href="javascript:history.back()" class="btn btn-secondary btn-back">Kembali</a>
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
    .container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
        background: #f4f4f9;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    }
    .page-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
    }
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background: #f9f9f9;
        height: 50px;
        font-size: 16px;
    }
    textarea.form-control {
        height: 120px;
        resize: none;
    }
    .image-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    .bukti-foto {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }
    .bukti-foto:hover {
        transform: scale(1.1);
    }
    .button-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }
    .btn {
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        transition: 0.3s;
        text-align: center;
    }
    .btn-print {
        background: #007bff;
        color: white;
    }
    .btn-print:hover {
        background: #0056b3;
    }
    .btn-back {
        background: #6c757d;
        color: white;
    }
    .btn-back:hover {
        background: #5a6268;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #printArea, #printArea * {
            visibility: visible;
        }
        .btn-print, .btn-back {
            display: none;
        }
    }
</style>

<?= $this->endSection(); ?>
