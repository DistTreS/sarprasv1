<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    /* Container Styles */
    .container.mt-5 {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Card Styles */
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 20px;
    }

    .card-header {
        font-size: 20px;
        font-weight: 600;
        padding: 20px;
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    /* Table Styles */
    .table {
        margin-bottom: 30px;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
        width: 100%;
        background-color: #f8f9fa;
    }

    .table-bordered th,
    .table-bordered td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    /* Button Styles */
    .btn-primary {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        background-color: #6c757d;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .container.mt-5 {
            padding: 15px;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 8px 10px;
            margin: 5px;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }

    .mt-4 a {
        margin-top: 12px;
    }
</style>


<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detail Peserta Diklat</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Nama</th>
                    <td><?= esc($peserta['nama'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td><?= esc($peserta['nip'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td><?= esc($peserta['tempat_lahir'] ?? '-') ?>, <?= esc($peserta['tanggal_lahir'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Golongan/Ruang</th>
                    <td><?= esc($peserta['golruang'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Nama Jabatan</th>
                    <td><?= esc($peserta['nama_jabatan'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Instansi</th>
                    <td><?= esc($peserta['instansi'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td><?= esc($peserta_diklat['angkatan'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Tahun</th>
                    <td><?= esc($peserta_diklat['tahun'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Sertifikat</th>
                    <td>
                        <?php if (!empty($peserta_diklat['sertifikat'])) : ?>
                            <a href="<?= base_url('uploads/sertifikat/' . $peserta_diklat['sertifikat']) ?>" class="btn btn-primary" download>
                                Download Sertifikat
                            </a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Judul Tugas Akhir</th>
                    <td><?= esc($peserta_diklat['judul_tugas_akhir'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>File Tugas Akhir</th>
                    <td>
                        <?php if (!empty($peserta_diklat['tugas_akhir'])) : ?>
                            <a href="<?= base_url('uploads/tugas_akhir/' . $peserta_diklat['tugas_akhir']) ?>" class="btn btn-primary" download>
                                Download Tugas Akhir
                            </a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>

            </table>
        </div>
        <div class="mt-4">
            <a href="<?= base_url('diklat') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>