<?= $this->extend('layout/main'); ?>



<?= $this->section('content'); ?>
<div class="edit-aset-container">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="aset-card card">
                    <div class="card-header-custom">
                        <h2 class="mb-0 fs-4 fw-bold"><i class="fas fa-edit me-2"></i> Edit Aset</h2>
                        <p class="mb-0 mt-2 opacity-75">Perbarui informasi aset dengan ID: <?= esc($aset['id_aset']); ?></p>
                    </div>
                    <div class="card-body p-4">
                        <a href="<?= base_url('peminjaman/daftarAset'); ?>" class="btn btn-back mb-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                        </a>
                        
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('aset/update/' . $aset['id_aset']); ?>" method="post" enctype="multipart/form-data" class="needs-validation form-floating-section" novalidate>
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_aset" value="<?= esc($aset['id_aset']); ?>">
                            
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label for="nama_aset" class="form-label">
                                            <i class="fas fa-box me-1 text-primary"></i> Nama Aset
                                        </label>
                                        <input type="text" id="nama_aset" name="nama_aset" value="<?= esc($aset['nama_aset']); ?>" 
                                            class="form-control <?= session()->getFlashdata('errors.nama_aset') ? 'is-invalid' : '' ?>" required>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.nama_aset') ?? 'Nama aset harus diisi' ?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="nup" class="form-label">
                                            <i class="fas fa-hashtag me-1 text-primary"></i> NUP
                                        </label>
                                        <input type="text" id="nup" name="nup" value="<?= esc($aset['nup']); ?>" 
                                            class="form-control <?= session()->getFlashdata('errors.nup') ? 'is-invalid' : '' ?>" required>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.nup') ?? 'NUP harus diisi' ?>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="kondisi" class="form-label">
                                                    <i class="fas fa-thermometer-half me-1 text-primary"></i> Kondisi
                                                </label>
                                                <div class="input-group">
                                                    <select id="kondisi" name="kondisi" class="form-select">
                                                        <option value="Baik" <?= $aset['kondisi'] == 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                                        <option value="Perbaikan" <?= $aset['kondisi'] == 'Perbaikan' ? 'selected' : ''; ?>>Perbaikan</option>
                                                    </select>
                                                    <span class="input-group-text <?= $aset['kondisi'] == 'Baik' ? 'kondisi-baik' : 'kondisi-perbaikan'; ?>">
                                                        <i class="fas <?= $aset['kondisi'] == 'Baik' ? 'fa-check-circle' : 'fa-tools'; ?>"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="status_aset" class="form-label">
                                                    <i class="fas fa-info-circle me-1 text-primary"></i> Status Aset
                                                </label>
                                                <div class="input-group">
                                                    <select id="status_aset" name="status_aset" class="form-select">
                                                        <option value="Tersedia" <?= $aset['status_aset'] == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                                        <option value="Terpakai" <?= $aset['status_aset'] == 'Terpakai' ? 'selected' : ''; ?>>Terpakai</option>
                                                    </select>
                                                    <span class="input-group-text <?= $aset['status_aset'] == 'Tersedia' ? 'status-tersedia' : 'status-terpakai'; ?>">
                                                        <i class="fas <?= $aset['status_aset'] == 'Tersedia' ? 'fa-check' : 'fa-clock'; ?>"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <div class="mb-4 h-100">
                                        <label for="gambar" class="form-label">
                                            <i class="fas fa-image me-1 text-primary"></i> Gambar Aset
                                        </label>
                                        <div class="image-preview-container text-center p-3 h-100 d-flex flex-column">
                                            <div class="flex-grow-1 d-flex align-items-center justify-content-center mb-3">
                                                <img src="<?= base_url('uploads/aset/' . esc($aset['gambar'])); ?>" 
                                                     class="img-preview img-fluid" alt="Preview Aset">
                                            </div>
                                            <div class="text-muted small mb-2">
                                                <i class="fas fa-file-image me-1"></i> <?= esc($aset['gambar']); ?>
                                            </div>
                                            <div class="file-upload-wrapper">
                                                <div class="input-group">
                                                    <input type="file" id="gambar" name="gambar" class="form-control file-upload-input" accept="image/*">
                                                    <label class="input-group-text" for="gambar"><i class="fas fa-upload"></i></label>
                                                </div>
                                                <div class="form-text">Format: JPG, PNG, atau JPEG (Maks. 2MB)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="<?= base_url('peminjaman/daftarAset'); ?>" class="btn btn-cancel">
                                    <i class="fas fa-times me-2"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-save">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted small">
                    <p>Terakhir diperbarui: <span id="last-update-time"><?= date('d M Y H:i'); ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Script validasi form dan preview gambar
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Validasi form
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Preview gambar yang diupload
        document.getElementById('gambar').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.img-preview').setAttribute('src', e.target.result);
                    
                    // Animasi preview
                    const preview = document.querySelector('.img-preview');
                    preview.style.opacity = '0';
                    setTimeout(() => {
                        preview.style.transition = 'all 0.5s ease';
                        preview.style.opacity = '1';
                    }, 100);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Efek hover pada form elements
        const formElements = document.querySelectorAll('.form-control, .form-select');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.parentElement.classList.add('element-focus');
            });
            
            element.addEventListener('blur', function() {
                this.parentElement.classList.remove('element-focus');
            });
        });
        
        // Animasi untuk card pada load
        const card = document.querySelector('.aset-card');
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease-out';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }, 100);
    }, false);
})();
</script>

<style>
    /* Custom styling untuk halaman edit aset */
    .edit-aset-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem 0;
        min-height: calc(100vh - 120px);
    }
    
    .aset-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .aset-card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    
    .card-header-custom {
        background: linear-gradient(90deg, #1a75ff 0%, #00ccff 100%);
        color: white;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .card-header-custom::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(25deg);
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.7rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
        border-color: #86b7fe;
    }
    
    .form-label {
        color: #495057;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .btn-back {
        background-color: #6c757d;
        color: white;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-back:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }
    
    .btn-save {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.7rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
    }
    
    .btn-save:hover {
        background: linear-gradient(90deg, #218838 0%, #1aa179 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(40, 167, 69, 0.3);
    }
    
    .btn-cancel {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.7rem 1.5rem;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background-color: #e9ecef;
    }
    
    .image-preview-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }
    
    .image-preview-container:hover {
        box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1);
    }
    
    .img-preview {
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }
    
    .img-preview:hover {
        transform: scale(1.02);
    }
    
    .file-upload-wrapper {
        position: relative;
        margin-top: 1rem;
    }
    
    .file-upload-input {
        padding-right: 95px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50rem;
        margin-left: 0.5rem;
    }
    
    .status-tersedia {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .status-terpakai {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .kondisi-baik {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    
    .kondisi-perbaikan {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .form-floating-section {
        animation: fadeInUp 0.5s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<?= $this->endSection(); ?>