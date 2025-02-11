<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h2>Daftar Kategori Aset</h2>

<!-- Tombol Tambah Kategori -->
<a href="<?= base_url('kategoriAset/tambah'); ?>" class="btn btn-primary">Tambah Kategori</a>

<!-- Tabel Daftar Kategori -->
<table border="1">
    <thead>
        <tr>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kategoriList as $kategori): ?>
        <tr>
            <td><?= esc($kategori['kode_kategori']); ?></td>
            <td><?= esc($kategori['nama_kategori']); ?></td>
            <td><?= esc($kategori['deskripsi']); ?></td>
            <td>
                <!-- Tombol Detail -->
                <a href="<?= base_url('kategoriAset/detail/' . $kategori['id_kategori']); ?>" class="btn btn-info">
                    <i class="fas fa-eye"></i> Lihat Aset
                </a>


                <!-- Tombol Edit (Modal) -->
                <a href="javascript:void(0);" class="btn-action"
                   onclick="openEditModal('<?= $kategori['kode_kategori']; ?>', '<?= $kategori['nama_kategori']; ?>', '<?= $kategori['deskripsi']; ?>')">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Tombol Hapus -->
                <a href="<?= base_url('kategoriAset/delete/' . $kategori['kode_kategori']); ?>" class="btn-action"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Edit Kategori -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h3>Edit Kategori Aset</h3>
        <form id="editForm" method="post" action="<?= base_url('kategoriAset/update'); ?>">
            <label>Kode Kategori</label>
            <input type="text" id="edit_kode_kategori" name="kode_kategori" readonly>

            <label>Nama Kategori</label>
            <input type="text" id="edit_nama_kategori" name="nama_kategori" required>

            <label>Deskripsi</label>
            <textarea id="edit_deskripsi" name="deskripsi" required></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    function openEditModal(kode, nama, deskripsi) {
        document.getElementById('edit_kode_kategori').value = kode;
        document.getElementById('edit_nama_kategori').value = nama;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>

<style>
    /* Modal Styling */
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); }
    .modal-content { background: white; padding: 20px; width: 30%; margin: auto; margin-top: 10%; border-radius: 5px; }
    .close { float: right; cursor: pointer; font-size: 20px; }
</style>

<?= $this->endSection(); ?>
