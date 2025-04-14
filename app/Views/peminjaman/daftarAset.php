<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h2><?= esc($title); ?></h2>



<!-- 🔹 Baris Atas: Form Pencarian + Tombol Tambah -->
<div class="aset-bar">
    <a href="<?= base_url('aset/create?kode_kategori=' . ($kode_kategori ?? '')); ?>" class="btn-tambah">Tambah Aset</a>
    <form action="<?= base_url('peminjaman/cariAset/' . esc($kode_kategori ?? '')); ?>" method="get" class="form-aset">
        <input type="text" name="search" value="<?= esc($search ?? ''); ?>" placeholder="Cari Nama Aset atau NUP" class="form-control" required>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>


<!-- 🔹 Tabel Daftar Aset -->
<table class="table">
    <thead>
        <tr>
            <th class="header-id">Nama Aset</th>
            <th class="header-id">NUP</th>
            <th class="header-kondisi">Kondisi</th>
            <th class="header-status_aset">Status Aset</th>
            <th class="header-gambar">Gambar</th>
            <th class="header-action">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($asetList as $aset): ?>
        <tr>
            <td><?= esc($aset['nama_aset']); ?></td>
            <td><?= esc($aset['nup']); ?></td> <!-- Menampilkan ID Aset -->
            <td><?= esc($aset['kondisi']); ?></td>
            <td><?= esc($aset['status_aset']); ?></td>
            <td>
                <img src="<?= base_url('uploads/aset/' . esc($aset['gambar'])); ?>" class="gambar-aset" alt="Tidak Ada Gambar">
            </td>
            <td>
                <!-- Tombol Edit -->
                <a href="<?= base_url('aset/edit/' . esc($aset['id_aset'])); ?>" class="btn-edit btn-action">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <!-- Tombol Hapus -->
                <button class="btn-delete btn-action btn-delete" data-delete-url="<?= base_url('aset/delete/' . esc($aset['id_aset'])); ?>">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<!-- 🔹 Tombol Kembali -->
<a href="<?= base_url('kategoriAset'); ?>" class="btn btn-secondary kembali">Kembali</a>

<!-- 🔹 CSS -->
<style>
    /* Semua tombol aksi */
    .btn-action {
        padding: 10px 15px;
        margin: 5px 2px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        color: white;
        transition: background-color 0.3s ease;
        text-decoration: none; /* untuk <a> */
        display: inline-block;
    }

    .btn-action i {
        color: white;
    }

    /* Tombol Edit */
    .btn-edit {
        background-color: #f1c40f; /* Kuning */
        color: #ddd;
    }

    .btn-edit:hover {
        background-color: #d4ac0d;
    }

    /* Tombol Hapus */
    .btn-delete {
        background-color: #e74c3c; /* Merah */
        color: #ddd;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    /* Styling Tombol Tambah Aset */
    .aset-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-aset {
        align-items: center;
    }

    .form-aset input[type="text"] {
        padding: 8px;
        width: 300px;
        margin-right: 10px;
    }

    .btn-tambah {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        white-space: nowrap;
    }

    h2 {
        margin-bottom: 10px;
        font-size: x-large; 
    }

    /* Styling Pop-up Modal Sesuai Gambar */
    .modal {
        display: none; /* Menyembunyikan modal saat halaman dimuat */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        margin: 10% auto;
        width: 50%;
        border-radius: 10px;
        position: relative;
        text-align: left;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .modal-content h3 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .modal-content label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .modal-content input[type="text"],
    .modal-content select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .modal-content .gambar-preview {
        display: block;
        width: 150px;
        height: 150px;
        margin: 10px auto;
        border: 1px solid #ccc;
        object-fit: cover;
    }

    .modal-content button {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .modal-content .btn-success {
        background-color: #28a745;
        color: white;
    }

    .modal-content .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
    }

    /* Styling Tabel */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-id {background-color: #343a40; color: white;}
    .header-kondisi { background-color: #343a40; color: white; }
    .header-status_aset  { background-color: #343a40; color: white; }
    .header-gambar  { background-color: #343a40; color: white; }
    .header-action  { background-color: #343a40; color: white; }

    .gambar-aset {
        width: 60px; 
        height: 60px; 
        object-fit: contain; 
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Tombol Kembali */
    .kembali {
        display: block;
        width: fit-content;
        padding: 10px 15px;
        margin: 20px auto;
        background-color: #6c757d;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
    }

    .kembali:hover {
        background-color: #545b62;
    }

    /* Styling Gambar Preview */
    .gambar-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ccc;
        display: block;
        margin: 10px auto;
    }
</style>

<!-- 🔹 Modal Hapus -->
<div id="deleteModal" class="modal">
    <div class="modal-content delete">
        <span class="close close-delete">&times;</span>
        <h3>Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus aset ini?</p>
        <form id="deleteForm" action="" method="post">
            <?= csrf_field(); ?>
            <button type="submit" class="btn btn-danger">Hapus</button>
            <button type="button" class="btn btn-secondary close-delete">Batal</button>
        </form>
    </div>
</div>

<!-- 🔹 JavaScript Modal Delete -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const closeButtons = document.querySelectorAll('.close-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('data-delete-url');
                deleteForm.setAttribute('action', url);
                deleteModal.style.display = 'block';
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                deleteModal.style.display = 'none';
            });
        });

        window.onclick = function (event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = 'none';
            }
        }
    });
</script>


<?= $this->endSection(); ?>
