<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    /* Container styles */
    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    /* Header styles */
    h2 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #007bff;
        border-radius: 2px;
    }

    /* Add button styles */
    .btn-primary {
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    /* Table styles */
    .table {
        width: 100%;
        margin-top: 25px;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
        padding: 15px;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody td {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        color: #495057;
        font-size: 14px;
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #f0f7ff;
    }

    /* Action buttons styles */
    .table td a {
        display: inline-block;
        padding: 6px 12px;
        margin: 0 4px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .table td a:first-child {
        background-color: #ffc107;
        color: #000;
    }

    .table td a:last-child {
        background-color: #dc3545;
        color: white;
    }

    .table td a:first-child:hover {
        background-color: #e0a800;
    }

    .table td a:last-child:hover {
        background-color: #c82333;
    }

    /* Empty state styles */
    .table td[colspan="4"] {
        text-align: center;
        padding: 30px;
        color: #6c757d;
        font-style: italic;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 20px;
        }

        h2 {
            font-size: 24px;
        }

        .table thead {
            display: none;
        }

        .table,
        .table tbody,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid #e9ecef;
        }

        .table td:before {
            content: attr(data-label);
            font-weight: 600;
            margin-right: 15px;
            text-align: left;
        }

        .table td:last-child {
            border-bottom: none;
        }
    }
</style>

<h2>Daftar Jenis Diklat</h2>
<a href="<?= base_url('diklat/tambahJenisDiklat'); ?>" class="btn btn-primary">Tambah Jenis Diklat</a>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Diklat</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($jenis_diklat)): ?>
            <?php $no = 1;
            foreach ($jenis_diklat as $jd): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($jd['nama_diklat']); ?></td>
                    <td><?= esc($jd['deskripsi']); ?></td>
                    <td>
                        <a href="<?= base_url('diklat/editJenisDiklat/' . $jd['id_diklat']); ?>">Edit</a>
                        <a href="<?= base_url('diklat/hapusJenisDiklat/' . $jd['id_diklat']); ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>