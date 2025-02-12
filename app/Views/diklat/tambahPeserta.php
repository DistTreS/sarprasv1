<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

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