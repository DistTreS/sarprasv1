<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    /* Reset and base styles */
    body {
        font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        line-height: 1.6;
    }

    /* Main container */
    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Header styles */
    h1 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    h1:after {
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

    /* Button styles */
    .btn {
        padding: 10px 20px;
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;

    }

    .btn-info {

        background-color: #17a2b8;
        color: white;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    /* Action buttons container */
    .mb-3.d-flex {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    /* Form styles */
    form {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    input[type="text"],
    select {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 14px;
        flex: 1;
        min-width: 200px;
        background-color: white;
        transition: border-color 0.2s ease;
    }

    input[type="text"]:focus,
    select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    /* Table styles */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 25px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        border: 1px solid #e9ecef;
        padding: 15px;
        text-align: left;
    }

    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #f0f7ff;
    }

    /* Action buttons in table */
    .table td .btn {
        padding: 6px 12px;
        margin: 0 4px;
        font-size: 13px;
    }

    /* Previous CSS remains the same until pagination styles */

    /* Pagination styles */
    .pagination {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 8px;
        list-style: none;
        /* Remove bullets */
        padding: 0;
        /* Remove default padding */
    }

    .pagination li {
        display: inline-flex;
        /* Ensure proper alignment */
    }

    .pagination a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 6px;
        background-color: white;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #dee2e6;
        transition: all 0.2s ease;
        min-width: 40px;
        /* Ensure consistent width */
    }

    .pagination a:hover {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .active a {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    /* Rest of the CSS remains the same */

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 20px;
        }

        .mb-3.d-flex {
            flex-direction: column;
        }

        form {
            flex-direction: column;
        }

        .table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="container">
    <h1>Data Peserta Diklat</h1>
    <div class="mb-3 d-flex justify-content-between">
        <a href="<?= site_url('diklat/exportToPdf') ?>?keyword=<?= esc($keyword) ?>&jenis_diklat=<?= esc($filterDiklat) ?>&instansi=<?= esc($instansi) ?>&angkatan=<?= esc($angkatan) ?>&tahun=<?= esc($tahun) ?>" class="btn btn-danger">Export ke PDF</a>
    </div>

    <!-- Form Pencarian dan Filter -->
    <form action="<?= site_url('diklat') ?>" method="GET" class="d-flex mb-3">
        <input type="text" name="keyword" placeholder="Cari Nama atau NIP" value="<?= esc($keyword) ?>" class="form-control me-2">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <form action="<?= site_url('diklat') ?>" method="GET" class="d-flex flex-wrap gap-2 mb-3">
        <select name="jenis_diklat" class="form-select">
            <option value="">Pilih Jenis Diklat</option>
            <?php foreach ($jenisDiklat as $jd) : ?>
                <option value="<?= $jd['id_diklat'] ?>" <?= $filterDiklat == $jd['id_diklat'] ? 'selected' : '' ?>>
                    <?= esc($jd['nama_diklat']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="instansi" class="form-select">
            <option value="">Semua Instansi</option>
            <?php foreach ($instansi_list as $instansi) : ?>
                <option value="<?= esc($instansi['instansi']) ?>" <?= $instansi == $instansi['instansi'] ? 'selected' : '' ?>>
                    <?= esc($instansi['instansi']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="angkatan" class="form-select">
            <option value="">Pilih Angkatan</option>
            <?php foreach ($angkatan_list as $row) : ?>
                <option value="<?= esc($row['angkatan']) ?>" <?= $angkatan == $row['angkatan'] ? 'selected' : '' ?>>
                    <?= esc($row['angkatan']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="tahun" class="form-select">
            <option value="">Pilih Tahun</option>
            <?php foreach ($tahun_list as $row) : ?>
                <option value="<?= esc($row['tahun']) ?>" <?= $tahun == $row['tahun'] ? 'selected' : '' ?>>
                    <?= esc($row['tahun']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-success">Filter</button>
    </form>

    <!-- Tabel Peserta Diklat -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Instansi</th>
                <th>Angkatan</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peserta_diklat)) : ?>
                <?php
                // Hitung nomor urut berdasarkan halaman saat ini
                $currentPage = $pager->getCurrentPage(); // Halaman saat ini
                $perPage = $pager->getPerPage(); // Jumlah data per halaman
                $no = ($currentPage - 1) * $perPage + 1; // Nomor awal untuk halaman ini
                ?>
                <?php foreach ($peserta_diklat as $peserta) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($peserta['nama']); ?></td>
                        <td><?= esc($peserta['nip']); ?></td>
                        <td><?= esc($peserta['instansi']); ?></td>
                        <td><?= esc($peserta['angkatan']); ?></td>
                        <td><?= esc($peserta['tahun']); ?></td>
                        <td>
                            <a href="<?= base_url('diklat/viewPeserta/' . $peserta['id_peserta'] . '/' . $peserta['id_diklat']); ?>" class="btn btn-info">View</a>
                            <a href="<?= base_url('diklat/editPeserta/' . $peserta['id_peserta'] . '/' . $peserta['id_diklat']); ?>" class="btn btn-warning">Edit</a>
                            <a href="<?= base_url('diklat/hapusPeserta/' . $peserta['id_peserta'] . '/' . $peserta['id_diklat']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">Delete</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data peserta diklat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>