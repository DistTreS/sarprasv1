<?= $this->extend('layout/mainpegawai') ?>

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
    .btn {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;

        display: inline-block;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        justify-content: center;
        background-color: rgb(165, 19, 22);
        color: white;
    }

    .btn-secondary:hover {
        background-color: rgb(179, 0, 0);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(252, 6, 6, 0.3);
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

    /* Profile Image Styles */
    .profile-img-container {
        margin-bottom: 10px;
    }

    .profile-img-preview {
        max-width: 100px;
        height: auto;
        border-radius: 6px;
        display: block;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }

    /* Additional Spacing */
    .mt-2 {
        margin-top: 10px;
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    /* Form Actions */
    .form-actions {
        margin-top: 30px;
        display: flex;
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

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
            margin-left: 0;
        }

        .btn-secondary {
            margin-left: 10px;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Edit User
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('profilepegawai/update/') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="full_name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-control" value="<?= esc($user['full_name']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control" value="<?= esc($user['no_telepon']) ?>">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= esc($user['alamat']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?= esc($user['jabatan']) ?>">
                </div>

                <div class="form-group">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="<?= esc($user['nip']) ?>">
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="profile_img" class="form-label">Foto Profil</label>
                    <?php if ($user['profile_img']): ?>
                        <div class="profile-img-container">
                            <img src="<?= base_url('uploads/' . $user['profile_img']) ?>" alt="Profile Image" class="profile-img-preview">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="profile_img" class="form-control mt-2">
                </div>



                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                <a href="<?= base_url('profil/pegawai') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>