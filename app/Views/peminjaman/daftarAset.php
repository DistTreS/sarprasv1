<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h2>Daftar Aset Kategori: <?= isset($kategori['nama_kategori']) ? esc($kategori['nama_kategori']) : 'Semua Kategori'; ?></h2>

<a href="<?= base_url('kategori'); ?>" class="btn btn-secondary">Kembali</a>
<a href="<?= base_url('aset/create'); ?>" class="btn btn-primary">Tambah Aset</a>

<table border="1">
    <thead>
        <tr>
            <th>ID Aset</th>
            <th>Status</th>
            <th>Kondisi</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($asetList as $aset): ?>
        <tr>
            <td><?= esc($aset['id_aset']); ?></td>
            <td><?= esc($aset['status']); ?></td>
            <td><?= esc($aset['kondisi']); ?></td>
            <td>
                <a href="<?= base_url('aset/edit/' . $aset['id_aset']); ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="<?= base_url('aset/delete/' . $aset['id_aset']); ?>" class="btn btn-danger"
                   onclick="return confirm('Yakin ingin menghapus aset ini?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>
