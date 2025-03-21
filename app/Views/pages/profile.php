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
    }

    .card-header {
        font-size: 22px;
        font-weight: 600;
        padding: 20px;
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .card-body {
        padding: 25px;
    }

    /* Profile Image Styles */
    .profile-image-container {
        text-align: center;
        margin-bottom: 25px;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #f8f9fa;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        display: inline-block;
    }

    .no-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #666;
    }

    /* User Info Styles */
    .user-info {
        margin-bottom: 30px;
    }

    .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        display: flex;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #555;
        width: 120px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        flex-grow: 1;
    }

    /* Action Buttons */
    .action-buttons {
        margin-top: 20px;
        align-items: center;
    }

    .btn {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        align-items: center;
        
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
        align-items: center;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
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

        .action-buttons {
            align-items: center;
        }

        .btn {
            width: 100%;
        }

        .info-item {
            flex-direction: column;
        }

        .info-label {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Detail User
        </div>
        <div class="card-body">
            <div class="profile-image-container">
                <?php if (!empty($user['profile_img'])): ?>
                    <img src="<?= base_url('uploads/' . $user['profile_img']) ?>" alt="Foto Profil" class="profile-image">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/profilepicturebasic.png') ?>" alt="Foto Profil" class="profile-image">
                <?php endif; ?>
            </div>

            <div class="user-info">
                <div class="info-item">
                    <div class="info-label">Nama</div>
                    <div class="info-value"><?= esc($user['full_name']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?= esc($user['email']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">No Telepon</div>
                    <div class="info-value"><?= esc($user['no_telepon']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Alamat</div>
                    <div class="info-value"><?= esc($user['alamat']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jabatan</div>
                    <div class="info-value"><?= esc($user['jabatan']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">NIP</div>
                    <div class="info-value"><?= esc($user['nip']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Username</div>
                    <div class="info-value"><?= esc($user['username']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Role</div>
                    <div class="info-value"><?= esc($user['role']) ?></div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url('/profile/edit') ?>" class="btn btn-edit">Edit Profil</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>