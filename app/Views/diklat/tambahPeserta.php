<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Tambah Peserta Diklat</h2>

    <!-- Pilihan Jenis Diklat -->
    <form action="<?= site_url('diklat/simpanPeserta') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="jenis_diklat" class="form-label">Jenis Diklat</label>
            <select class="form-control" name="jenis_diklat" id="jenis_diklat" required>
                <option value="">-- Pilih Jenis Diklat --</option>
                <?php foreach ($jenisDiklat as $jd) : ?>
                    <option value="<?= $jd['id_diklat'] ?>" <?= isset($_GET['jenis_diklat']) && $_GET['jenis_diklat'] == $jd['id_diklat'] ? 'selected' : '' ?>>
                        <?= $jd['nama_diklat'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Pilihan Tambah Data: Manual atau Upload -->
        <ul class="nav nav-tabs mb-3" id="dataTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manualInput" type="button" role="tab">Input Manual</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="excel-tab" data-bs-toggle="tab" data-bs-target="#excelUpload" type="button" role="tab">Upload Excel</button>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Form Manual -->
            <div class="tab-pane fade show active" id="manualInput" role="tabpanel">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" name="nip" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="golruang" class="form-label">Golruang</label>
                    <input type="text" class="form-control" name="golruang" required>
                </div>
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control" name="nama_jabatan" required>
                </div>
                <div class="mb-3">
                    <label for="instansi" class="form-label">Instansi</label>
                    <input type="text" class="form-control" name="instansi" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="angkatan" class="form-label">Angkatan</label>
                        <input type="text" class="form-control" name="angkatan" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="judul_tugas_akhir" class="form-label">Judul Tugas Akhir</label>
                    <input type="text" class="form-control" name="judul_tugas_akhir">
                </div>
                <div class="mb-3">
                    <label for="sertifikat" class="form-label">Upload Sertifikat</label>
                    <input type="file" class="form-control" name="sertifikat">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <!-- Form Upload Excel -->
            <div class="tab-pane fade" id="excelUpload" role="tabpanel">
                <div class="mb-3">
                    <label for="file_excel" class="form-label">Upload File Excel</label>
                    <input type="file" class="form-control" name="file_excel" accept=".xlsx, .xls" required>
                </div>
                <button type="submit" formaction="<?= site_url('diklat/importPeserta') ?>" class="btn btn-success">Upload</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>