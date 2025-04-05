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

<!-- Tombol Tambah Kategori -->
<a href="<?= base_url('kategoriAset/tambah'); ?>" class="tambah-aset">Tambah Kategori</a>

<!-- Form Pencarian -->
<form method="get" action="<?= base_url('kategoriAset'); ?>" style="margin-bottom: 20px;">
    <input type="text" name="keyword" placeholder="Cari kode atau nama kategori..." value="<?= esc($_GET['keyword'] ?? '') ?>" style="padding: 8px; width: 300px;">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>


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
                    <a href="<?= base_url('kategoriAset/detail/' . $kategori['kode_kategori']); ?>" class="btn btn-info">
                        <i class="fas fa-eye"></i> Lihat Aset
                    </a>

                    <!-- Tombol Edit (Modal) -->
                    <button class="btn btn-edit" data-kode="<?= $kategori['kode_kategori']; ?>" data-nama="<?= $kategori['nama_kategori']; ?>" data-deskripsi="<?= $kategori['deskripsi']; ?>">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Tombol Hapus (Modal) -->
                    <button class="btn btn-delete" data-id="<?= $kategori['kode_kategori']; ?>">
                        <i class="fas fa-trash"></i>
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

<!-- 🔹 CSS -->
<style>
    .tambah-aset {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        margin-bottom: 15px;
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
        margin-top: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-No {
        background-color: #34495E;
        color: white;
    }

    .header-Kode {
        background-color: #2C3E50;
        color: white;
    }

    .header-Nama {
        background-color: #2C3E50;
        color: white;
    }

    .header-Deskripsi {
        background-color: #1B4F72;
        color: white;
    }

    .header-Jumlah {
        background-color: #154360;
        color: white;
    }

    .header-action {
        background-color: #0E6251;
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