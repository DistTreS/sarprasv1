<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h2>Daftar Jenis Diklat</h2>
<a href="<?= base_url('diklat/tambahJenisDiklat'); ?>" class="btn btn-primary">Tambah Jenis Diklat</a>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Diklat</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($jenis_diklat)): ?>
            <?php $no = 1;
            foreach ($jenis_diklat as $jd): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($jd['nama_diklat']); ?></td>
                    <td><?= esc($jd['deskripsi']); ?></td>
                    <td>
                        <a href="<?= base_url('diklat/editJenisDiklat/' . $jd['id_diklat']); ?>">Edit</a>
                        <a href="<?= base_url('diklat/hapusJenisDiklat/' . $jd['id_diklat']); ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>