<?= $this->extend('layout/mainguest') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Lihat Tugas Akhir - <?= esc($peserta['nama']) ?></h2>
        </div>
        <div class="card-body">
            <div style="position: relative;">
                <!-- Transparent overlay untuk mencegah seleksi teks tapi mengizinkan scrolling -->
                <div style="position: absolute; top: 0; left: 0; width: 95%; height: 100%; z-index: 1;"></div>

                <iframe
                    src="<?= base_url('uploads/tugas_akhir/' . $peserta_diklat['tugas_akhir']) ?>#toolbar=0&copy=0&select=0"
                    type="application/pdf"
                    width="100%"
                    height="600px"
                    style="border: 1px solid #dee2e6; border-radius: 8px;"
                    frameborder="0">
                </iframe>
            </div>
        </div>
    </div>
</div>

<style>
    /* Minimal styling yang diperlukan */
    .card {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Style untuk mencegah seleksi teks tapi mengizinkan scrolling */
    iframe {
        pointer-events: auto !important;
        /* Memastikan scrolling PDF berfungsi */
    }
</style>
<?= $this->endSection() ?>