<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    /* Container Styles */
    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Card Styles */
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .card-header {
        font-size: 22px;
        font-weight: 600;
        padding: 20px;
        background-color: #007bff;
        color: white;
        text-align: center;
        border-bottom: none;
    }

    .card-body {
        padding: 25px;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    textarea.form-control {
        min-height: 100px;
    }

    select.form-control {
        padding-right: 30px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='6' fill='%23666' viewBox='0 0 8 6'%3E%3Cpath d='M0 0l4 6 4-6z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 8px 6px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    /* Button Styles */
    .btn-primary {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        color: white;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        background-color: #6c757d;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Alert Styles */
    .alert {
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 6px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    /* File Input Styles */
    .file-input {
        position: relative;
    }

    .file-input input[type="file"] {
        padding: 8px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .card-header {
            padding: 15px;
        }

        .card-body {
            padding: 15px;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Tambah User</h2>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/users/store" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">No Telepon:</label>
                    <input type="text" name="no_telepon" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Jabatan:</label>
                    <input type="text" name="jabatan" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">NIP:</label>
                    <input type="text" name="nip" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Role:</label>
                    <select name="role" class="form-control">
                        <option value="Pegawai">Pegawai</option>
                        <option value="Admin Utama">Admin Utama</option>
                        <option value="Admin Peminjaman">Admin Peminjaman</option>
                        <option value="Admin Barang">Admin Barang</option>
                        <option value="Admin Diklat">Admin Diklat</option>
                        <option value="Admin Peminjaman dan Barang">Admin Peminjaman dan Barang</option>
                        <option value="Admin Peminjaman dan Diklat">Admin Peminjaman dan Diklat</option>
                        <option value="Admin Barang dan Diklat">Admin Barang dan Diklat</option>
                    </select>
                </div>

                <div class="form-group file-input">
                    <label class="form-label">Profile Image:</label>
                    <input type="file" name="profile_img" class="form-control">
                </div>

                <div>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>

            <div>
                <a href="/users" class="btn-secondary">Kembali ke daftar user</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>