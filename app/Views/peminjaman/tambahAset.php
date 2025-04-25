<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- 🔹 CSS Styling -->
<style>
    /* Styling Container Form */
    .form-container {
        background-color: white;
        padding: 30px;
        margin: 30px auto;
        width: 60%;
        /* Diperbesar */
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
    }

    .form-container h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 25px;
        color: #2C3E50;
        font-size: 24px;
        /* Diperbesar */
    }

    /* Styling Form */
    .form-container form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-container label {
        font-weight: bold;
        color: #34495E;
        font-size: 16px;
        /* Diperbesar */
    }

    .form-container select,
    .form-container input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        /* Diperbesar */
    }

    /* Styling Tombol */
    .form-container button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        /* Diperbesar */
        cursor: pointer;
        color: white;
        background-color: #28a745;
        /* Hijau */
        transition: 0.3s ease;
    }

    .form-container button:hover {
        background-color: #218838;
    }

    /* Styling Tombol Kembali */
    .btn-kembali {
        display: block;
        width: fit-content;
        padding: 12px 20px;
        margin: 20px auto;
        background-color: #6c757d;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
        transition: 0.3s ease;
    }

    .btn-kembali:hover {
        background-color: #545b62;
    }

    /* Styling Input File */
    .form-container input[type="file"] {
        padding: 8px;
        background-color: #f8f9fa;
        border: 1px solid #ccc;
    }

    /* Styling untuk Responsive */
    @media screen and (max-width: 768px) {
        .form-container {
            width: 85%;
        }

        .form-container h2 {
            font-size: 20px;
        }

        .form-container button {
            font-size: 16px;
        }
    }
</style>



<!-- 🔹 Form Tambah Aset -->
<div class="form-container">
    <h2>Tambah Aset Baru</h2>

    <form action="<?= base_url('aset/store'); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <!-- 🔹 Tambahkan input hidden agar kode_kategori tetap terkirim -->
        <input type="hidden" name="kode_kategori" id="kode_kategori_hidden" value="<?= esc($kode_kategori ?? ''); ?>">

        <!-- 🔹 Kategori (Dropdown hanya untuk tampilan) -->
        <label for="kode_kategori">Kategori:</label>
        <select name="kode_kategori_display" id="kode_kategori_display" disabled required>
            <option value="<?= esc($kode_kategori); ?>" selected>
                <?= esc($nama_kategori); ?>
            </option>
        </select>

        <script>
            // Pastikan input hidden mendapatkan nilai dari dropdown
            document.addEventListener('DOMContentLoaded', function() {
                let selectedKategori = document.querySelector('#kode_kategori_display').value;
                document.querySelector('#kode_kategori_hidden').value = selectedKategori;
            });
        </script>



        <!-- 🔹 Nama Aset -->
        <label for="nama_aset">Nama Aset:</label>
        <input type="text" name="nama_aset" value="<?= old('nama_aset'); ?>" required>

        <!-- 🔹 NUP -->
        <label for="nup">NUP:</label>
        <input type="text" name="nup" value="<?= old('nup'); ?>" required>

        <label for="status_aset">Status:</label>
        <select name="status_aset">
            <option value="Tersedia" <?= old('status_aset') == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
            <option value="Tidak Tersedia" <?= old('status_aset') == 'Tidak Tersedia' ? 'selected' : ''; ?>>Tidak Tersedia</option>
        </select>

        <label for="kondisi">Kondisi:</label>
        <select name="kondisi">
            <option value="Baik" <?= old('kondisi') == 'Baik' ? 'selected' : ''; ?>>Baik</option>
            <option value="Perbaikan" <?= old('kondisi') == 'Perbaikan' ? 'selected' : ''; ?>>Perbaikan</option>
        </select>

        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit"><i class="fas fa-save"></i> Simpan</button>
</div>
</form>

<script>
    document.querySelector('input[name="gambar"]').addEventListener('change', function(e) {
        let file = e.target.files[0];
        if (file) {
            let allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Format gambar tidak valid! Hanya PNG, JPG, dan JPEG diperbolehkan.'
                });
                e.target.value = ''; // Hapus file dari input
            }
        }
    });
</script>



<?= $this->endSection(); ?>