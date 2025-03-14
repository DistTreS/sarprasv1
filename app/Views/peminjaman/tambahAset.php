<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- 🔹 CSS Styling -->
<style>
    /* Styling Container Form */
    .form-container {
        background-color: white;
        padding: 30px;
        margin: 30px auto;
        width: 60%; /* Diperbesar */
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
    }

    .form-container h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 25px;
        color: #2C3E50;
        font-size: 24px; /* Diperbesar */
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
        font-size: 16px; /* Diperbesar */
    }

    .form-container select,
    .form-container input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px; /* Diperbesar */
    }

    /* Styling Tombol */
    .form-container button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 18px; /* Diperbesar */
        cursor: pointer;
        color: white;
        background-color: #28a745; /* Hijau */
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

<!-- 🔹 Tombol Kembali -->
<a href="<?= isset($_GET['id_kategori']) && $_GET['id_kategori'] ? base_url('aset/' . $_GET['id_kategori']) : base_url('aset'); ?>" 
   class="btn-kembali">
    <i class="fas fa-arrow-left"></i> Kembali
</a>




<!-- 🔹 Form Tambah Aset -->
<div class="form-container">
    <h2>Tambah Aset Baru</h2>

    <form action="<?= base_url('aset/store'); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <label for="kategori">Kategori:</label>
        <select name="id_kategori" disabled>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori']; ?>" <?= ($kat['id_kategori'] == $id_kategori) ? 'selected' : ''; ?>>
                    <?= esc($kat['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- 🔹 Tambahkan input hidden agar id_kategori tetap dikirim ke backend -->
        <input type="hidden" name="id_kategori" value="<?= old('id_kategori', $id_kategori); ?>">


        <label for="status">Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Terpakai">Terpakai</option>
        </select>

        <label for="kondisi">Kondisi:</label>
        <select name="kondisi">
            <option value="Baik">Baik</option>
            <option value="Perbaikan">Perbaikan</option>
        </select>

        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <button type="submit"><i class="fas fa-save"></i> Simpan</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (session()->has('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session('error'); ?>'
            });
        <?php endif; ?>
    });
</script>


<?= $this->endSection(); ?>
