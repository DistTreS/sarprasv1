<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h2>Edit Jenis Diklat</h2>

<form action="<?= base_url('diklat/updateJenisDiklat/' . $jenis_diklat['id_diklat']); ?>" method="post">
    <?= csrf_field(); ?>
    
    <div class="mb-3">
        <label for="nama_diklat" class="form-label">Nama Diklat</label>
        <input type="text" class="form-control" id="nama_diklat" name="nama_diklat" value="<?= esc($jenis_diklat['nama_diklat']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= esc($jenis_diklat['deskripsi']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('diklat'); ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>
