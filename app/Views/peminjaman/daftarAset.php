<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<h2><?= esc($title); ?></h2>



<!-- 🔹 Tombol Tambah Aset -->
<a href="<?= base_url('aset/create?kode_kategori=' . ($kode_kategori ?? '')); ?>" class="btn-tambah">Tambah Aset</a>



<form action="<?= base_url('peminjaman/cariAset/' . esc($kode_kategori ?? '')); ?>" method="get" class="form-inline">
    <input type="text" name="search" value="<?= esc($search ?? ''); ?>" placeholder="Cari Nama Aset atau NUP" class="form-control" required>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>


<!-- 🔹 Tabel Daftar Aset -->
<table class="table">
    <thead>
        <tr>
            <th class="header-id">Nama Aset</th>
            <th class="header-id">NUP</th>
            <th class="header-kondisi">Kondisi</th>
            <th class="header-status_aset">Status Aset</th>
            <th class="header-gambar">Gambar</th>
            <th class="header-action">Action</th>
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
                <img src="<?= base_url('uploads/aset/' . esc($aset['gambar'])); ?>" class="gambar-aset" alt="Gambar Aset">
            </td>
            <td>
                <button>
                <a href="<?= base_url('aset/edit/' . esc($aset['id_aset'])); ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                </button>

                <button class="btn btn-danger btn-delete" data-id="<?= esc($aset['id_aset']); ?>">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


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

<!-- 🔹 JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editModal = document.getElementById('editModal');
        const editGambarInput = document.getElementById('edit_gambar');
        const editGambarPreview = document.getElementById('edit_gambar_preview');

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('id_aset').value = this.dataset.id;
                document.getElementById('edit_status_aset').value = this.dataset.status_aset;
                document.getElementById('edit_kondisi').value = this.dataset.kondisi;
                document.getElementById('edit_gambar_preview').src = this.dataset.gambar;
                document.getElementById('editModal').style.display = 'block';
            });
        });


        document.querySelectorAll('.close-edit').forEach(button => {
            button.addEventListener('click', () => editModal.style.display = 'none');
        });

        // Preview gambar baru sebelum diupload
        editGambarInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    editGambarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Modal Hapus
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                deleteForm.action = "<?= base_url('aset/delete/'); ?>" + this.dataset.id;
                deleteModal.style.display = 'block';
                });
            });

        document.querySelectorAll('.close-delete').forEach(button => {
                button.addEventListener('click', () => deleteModal.style.display = 'none');
            });

        // Tutup modal saat klik di luar modal
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            };
    });
</script>

<!-- 🔹 Tombol Kembali -->
<a href="<?= base_url('kategoriAset'); ?>" class="btn btn-secondary kembali">Kembali</a>

<!-- 🔹 CSS -->
<style>
    /* Styling Tombol Tambah Aset */
    .btn-tambah {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        margin-bottom: 15px;
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
        margin-top: 20px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .header-id {background-color: #34495E; color: white;}
    .header-kondisi { background-color: #2C3E50; color: white; }
    .header-status_aset  { background-color: #1B4F72; color: white; }
    .header-gambar  { background-color: #154360; color: white; }
    .header-action  { background-color: #0E6251; color: white; }

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

<?= $this->endSection(); ?>
