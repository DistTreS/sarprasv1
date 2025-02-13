<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
    /* Form Container Styles */
    .container.mt-4 {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Header Styles */
    h2.mb-4 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    h2.mb-4:after {
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

    /* Import Excel Button */
    .btn-success {
        margin-bottom: 25px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.5px;
        background-color: #28a745;
        border: none;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.3);
        background-color: #218838;
    }

    /* Form Styles */
    form {
        display: grid;
        gap: 20px;
        margin-top: 25px;
    }

    label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background-color: #ffffff;
    }

    /* Select Styles */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 15px;
        padding-right: 45px;
    }

    /* File Input Styles */
    input[type="file"].form-control {
        padding: 8px 12px;
    }

    /* Submit Button */
    .btn-primary {
        margin-top: 10px;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.5px;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2);
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
        background-color: #0056b3;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 2px solid #f8f9fa;
        padding: 20px;
    }

    .modal-title {
        font-weight: 600;
        color: #1a1a1a;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        border-top: 2px solid #f8f9fa;
        padding: 20px;
    }

    .btn-close {
        opacity: 0.5;
        transition: opacity 0.2s ease;
    }

    .btn-close:hover {
        opacity: 1;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container.mt-4 {
            margin: 20px;
            padding: 20px;
        }

        h2.mb-4 {
            font-size: 24px;
        }

        .form-control {
            padding: 10px 12px;
        }
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Tambah Peserta Diklat</h2>

    <!-- Tombol Import Excel -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
        Import Excel
    </button>

    <!-- Modal Upload Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Upload File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('diklat/importExcel') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Pilihan Jenis Diklat -->
                        <label for="id_diklat">Pilih Jenis Diklat</label>
                        <select class="form-control" name="id_diklat" required>
                            <option value="">Pilih Jenis Diklat</option>
                            <?php foreach ($diklat as $d) : ?>
                                <option value="<?= $d['id_diklat'] ?>"><?= $d['nama_diklat'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Upload File -->
                        <label for="file_excel" class="mt-3">Upload File Excel</label>
                        <input type="file" class="form-control" name="file_excel" accept=".xlsx, .xls" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Pilihan Jenis Diklat -->
    <form action="<?= base_url('diklat/tambahPeserta') ?>" method="post">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" name="nama" required>

        <label for="nip">NIP</label>
        <input type="text" class="form-control" name="nip" required>

        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" class="form-control" name="tempat_lahir" required>

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" required>

        <label for="golruang">Golongan Ruang</label>
        <input type="text" class="form-control" name="golruang" required>

        <label for="nama_jabatan">Nama Jabatan</label>
        <input type="text" class="form-control" name="nama_jabatan" required>

        <label for="instansi">Instansi</label>
        <input type="text" class="form-control" name="instansi" required>

        <label for="id_diklat">Jenis Diklat</label>
        <select class="form-control" name="id_diklat" required>
            <option value="">Pilih Jenis Diklat</option>
            <?php foreach ($diklat as $d) : ?>
                <option value="<?= $d['id_diklat'] ?>"><?= $d['nama_diklat'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="angkatan">Angkatan</label>
        <input type="text" class="form-control" name="angkatan" required>

        <label for="tahun">Tahun</label>
        <input type="text" class="form-control" name="tahun" required>

        <label for="sertifikat">Sertifikat (PDF)</label>
        <input type="file" class="form-control" name="sertifikat" accept=".pdf">

        <label for="judul_tugas_akhir">Judul Tugas Akhir</label>
        <input type="text" class="form-control" name="judul_tugas_akhir">

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

<?= $this->endSection() ?>