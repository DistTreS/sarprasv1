<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-danger" style="color: red; font-size: 18px; font-weight: bold;">
        <?= session('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->has('success')) : ?>
    <div class="alert alert-success" style="color: green; font-size: 18px; font-weight: bold;">
        <?= session('success') ?>
    </div>
<?php endif; ?>



<h2>Daftar Kategori Aset</h2>

<!-- 🔹 Tombol dan Form Pencarian dalam Flexbox -->
<div class="top-bar">
    <a href="<?= base_url('kategoriAset/tambah'); ?>" class="tambah-aset">Tambah Kategori</a>
    <form method="get" action="<?= base_url('kategoriAset'); ?>" class="form-cari">
        <input type="text" name="keyword" placeholder="Cari kode atau nama kategori" value="<?= esc($_GET['keyword'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>


<!-- Tabel Daftar Kategori -->
<table class="table">
    <thead>
        <tr>
            <th class="header-No">No</th>
            <th class="header-Kode">Kode Kategori</th>
            <th class="header-Nama ">Nama Kategori</th>
            <th class="header-Deskripsi">Deskripsi</th>
            <th class="header-Jumlah Aset">Jumlah Aset</th>
            <th class="header-action">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($kategoriList as $kategori): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($kategori['kode_kategori']); ?></td>
                <td><?= esc($kategori['nama_kategori']); ?></td>
                <td><?= esc($kategori['deskripsi']); ?></td>
                <td><?= esc($kategori['jumlah_aset'] ?? 0); ?></td>
                <td>
                <!-- Tombol Aset (dalam bentuk button) -->
                <button class="btn btn-info btn-aset" data-url="<?= base_url('kategoriAset/detail/' . $kategori['kode_kategori']); ?>">
                    <i class="fas fa-eye"></i> Detail
                </button>

                <!-- Tombol Edit (Modal) -->
                <button class="btn btn-edit" data-kode="<?= $kategori['kode_kategori']; ?>" data-nama="<?= $kategori['nama_kategori']; ?>" data-deskripsi="<?= $kategori['deskripsi']; ?>">
                    <i class="fas fa-edit"></i> Edit
                </button>

                <!-- Tombol Hapus (Modal) --> 
                <button class="btn btn-delete" data-id="<?= $kategori['kode_kategori']; ?>">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🔹 Modal Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close close-edit">&times;</span>
        <h3>Edit Kategori Aset</h3>
        <form id="editForm" method="post" action="<?= base_url('kategoriAset/update'); ?>">
            <label>Kode Kategori</label>
            <input type="text" id="edit_kode_kategori" name="kode_kategori" readonly>

            <label>Nama Kategori</label>
            <input type="text" id="edit_nama_kategori" name="nama_kategori" required>

            <label>Deskripsi</label>
            <textarea id="edit_deskripsi" name="deskripsi" required></textarea>

            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary close-edit">Batal</button>
        </form>
    </div>
</div>

<!-- 🔹 Modal Hapus -->
<div id="deleteModal" class="modal">
    <div class="modal-content delete">
        <span class="close close-delete">&times;</span>
        <h3>Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
        <form id="deleteForm" action="" method="post">
            <?= csrf_field(); ?>
            <button type="submit" class="btn btn-danger">Hapus</button>
            <button type="button" class="btn btn-secondary close-delete">Batal</button>
        </form>
    </div>
</div>

<!-- 🔹 JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit_kode_kategori').value = this.dataset.kode;
                document.getElementById('edit_nama_kategori').value = this.dataset.nama;
                document.getElementById('edit_deskripsi').value = this.dataset.deskripsi;
                document.getElementById('editModal').style.display = 'block';
            });
        });

        document.querySelectorAll('.close-edit').forEach(button => {
            button.addEventListener('click', () => document.getElementById('editModal').style.display = 'none');
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('deleteForm').action = "<?= base_url('kategoriAset/delete/'); ?>" + this.dataset.id;
                document.getElementById('deleteModal').style.display = 'block';
            });
        });

        document.querySelectorAll('.close-delete').forEach(button => {
            button.addEventListener('click', () => document.getElementById('deleteModal').style.display = 'none');
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        };
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const asetButtons = document.querySelectorAll('.btn-aset');
        asetButtons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                window.location.href = url;
            });
        });
    });
</script>


<!-- 🔹 CSS -->
<style>
    /* Semua tombol aksi */
    .btn-action {
        padding: 15px 20px;
        margin: 5px 2px;
        font-size: 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        color: white;
        transition: background-color 0.3s ease;
    }

    /* Tombol Aset */
    .btn-aset {
        background-color: #3498db; /* Biru */
        color: #ddd;
    }

    .btn-aset:hover {
        background-color: #2c80b4;
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


    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .form-cari {
        align-items: center;
    }


    .form-cari input[type="text"] {
        padding: 8px;
        width: 300px;
        margin-right: 10px;
    }

    .tambah-aset {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        white-space: nowrap;
    }


    h2 {
        margin-bottom: 20px; 
        text-align: center;
        font-size: x-large;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        margin: 10% auto;
        width: 50%;
        border-radius: 10px;
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

    .modal-content input,
    .modal-content textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-No {
        background-color: #343a40;
        color: white;
    }

    .header-Kode {
        background-color: #343a40;
        color: white;
    }

    .header-Nama {
        background-color: #343a40;
        color: white;
    }

    .header-Deskripsi {
        background-color: #343a40;
        color: white;
    }

    .header-Jumlah {
        background-color: #343a40;
        color: white;
    }

    .header-action {
        background-color: #343a40;
        color: white;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-secondary {
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
</style>

<?= $this->endSection(); ?>