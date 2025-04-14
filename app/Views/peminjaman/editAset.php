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
                                                        <option value="Tidak Tersedia" <?= $aset['status_aset'] == 'Tidak Tersedia"i' ? 'selected' : ''; ?>>Tidak Tersedia"</option>
                                                    </select>
                                                    <span class="input-group-text <?= $aset['status_aset'] == 'Tersedia' ? 'status-tersedia' : 'status-tidak-tersedia"'; ?>">
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
                                <a href="<?= base_url('kategoriAset/detail/' . $aset['kode_kategori']); ?>" class="btn btn-back">
                                     Kembali
                                </a>
                                
                                <button type="submit" class="btn btn-save">
                                     Simpan Perubahan
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

<style>
   /* Global Reset & Font Scaling */
* {
    box-sizing: border-box;
}

body {
    font-size: 16px;
    line-height: 1.6;
}

/* Container utama halaman edit aset */
.edit-aset-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2rem 0;
    min-height: calc(100vh - 120px);
}

/* Card aset */
.aset-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    padding: 2rem;
    margin: 1rem;
}

.aset-card:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    transform: translateY(-5px);
}

/* Header Card */
.card-header-custom {
    background: linear-gradient(90deg, #1a75ff 0%, #00ccff 100%);
    color: white;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
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

/* Form Elements */
.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1rem;
    color: #495057;
    display: block;
}

.form-control,
.form-select {
    border-radius: 8px;
    padding: 0.7rem 1rem;
    border: 1px solid #dee2e6;
    transition: all 0.3s;
    font-size: 1rem;
    width: 100%;
    margin-bottom: 1rem;
}

.form-control:focus,
.form-select:focus {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
    border-color: #86b7fe;
}

/* Tombol Aksi */
.btn-save,
.btn-cancel,
.btn-back {
    padding: 0.7rem 1.5rem;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s;
    margin-right: 0.5rem;
}

/* Tombol Save */
.btn-save {
    background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
}

.btn-save:hover {
    background: linear-gradient(90deg, #218838 0%, #1aa179 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(40, 167, 69, 0.3);
}

/* Tombol Kembali */
.btn-back {
    background-color: #6c757d;
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    text-decoration: none;
}

.btn-back:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

/* Preview Gambar */
.image-preview-container {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
    margin-bottom: 1rem;
}

.image-preview-container:hover {
    box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1);
}

.img-preview {
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    width: 100%;
    object-fit: cover;
}

.img-preview:hover {
    transform: scale(1.02);
}

/* File Upload */
.file-upload-wrapper {
    position: relative;
    margin-top: 1rem;
}

.file-upload-input {
    padding-right: 95px;
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 0.35rem 0.65rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 50rem;
    margin-left: 0.5rem;
}

.status-tidak-tersedia {
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