<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Diklat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Data Peserta Diklat</h2>
        <div class="mb-3 d-flex justify-content-between">
            <a href="<?= base_url('diklat/tambahPeserta'); ?>" class="btn btn-primary">Tambah Peserta</a>
            <a href="<?= base_url('diklat/jenisDiklat') ?>" class="btn btn-secondary">Kelola Jenis Diklat</a>
            <a href="<?= site_url('diklat/exportToPdf') ?>?keyword=<?= $keyword ?>&jenis_diklat=<?= $filterDiklat ?>&instansi=<?= $instansi ?>&angkatan=<?= $angkatan ?>&tahun=<?= $tahun ?>" class="btn btn-danger mb-3">Export ke PDF</a>

        </div>

        <!-- Form Pencarian dan Filter -->
        <form action="<?= site_url('diklat') ?>" method="GET" class="mb-3 d-flex gap-2">
            <!-- Input Pencarian -->
            <input type="text" name="keyword" class="form-control" placeholder="Cari Nama atau NIP" value="<?= esc($keyword ?? '') ?>">

            <!-- Tombol Cari -->
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- Form Filter -->
        <form action="<?= site_url('diklat') ?>" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="id_diklat" class="form-control">
                        <option value="">Pilih Jenis Diklat</option>
                        <?php foreach ($jenisDiklat as $jd) : ?>
                            <option value="<?= $jd['id_diklat'] ?>" <?= isset($_GET['jenis_diklat']) && $_GET['jenis_diklat'] == $jd['id_diklat'] ? 'selected' : '' ?>>
                                <?= $jd['nama_diklat'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="instansi">
                        <option value="">Semua Instansi</option>
                        <?php foreach ($instansi_list as $instansi): ?>
                            <option value="<?= esc($instansi['instansi']) ?>"><?= esc($instansi['instansi']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="angkatan" class="form-control">
                        <option value="">Pilih Angkatan</option>
                        <?php foreach ($angkatan_list as $row) : ?>
                            <option value="<?= $row['angkatan'] ?>" <?= isset($_GET['angkatan']) && $_GET['angkatan'] == $row['angkatan'] ? 'selected' : '' ?>>
                                <?= $row['angkatan'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        <?php foreach ($tahun_list as $row) : ?>
                            <option value="<?= $row['tahun'] ?>" <?= isset($_GET['tahun']) && $_GET['tahun'] == $row['tahun'] ? 'selected' : '' ?>>
                                <?= $row['tahun'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </div>
        </form>


        <!-- Tabel Peserta Diklat -->
        <table class="table table-bordered table-striped">
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
                    <?php $no = 1; // Mulai dari 1 
                    ?>
                    <?php foreach ($peserta_diklat as $peserta) : ?>
                        <tr>
                            <td><?= $no++; ?></td> <!-- Tambahkan nomor urut -->
                            <td><?= esc($peserta['nama']); ?></td>
                            <td><?= esc($peserta['nip']); ?></td>
                            <td><?= esc($peserta['instansi']); ?></td>
                            <td><?= esc($peserta['angkatan']); ?></td>
                            <td><?= esc($peserta['tahun']); ?></td>
                            <td>
                                <a href="<?= base_url('diklat/viewPeserta/' . $peserta['id_peserta']); ?>" class="btn btn-info">View</a>
                                <a href="<?= base_url('diklat/editPeserta/' . $peserta['id_peserta_diklat']); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('diklat/hapusPeserta/' . $peserta['id_peserta_diklat']); ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>

                    <tr>
                        <td colspan="6">Tidak ada data peserta diklat.</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>

        <!-- Pagination -->
        <?= $pager->links() ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>