<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    /* Container Styles */
    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 25px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Header Styles */
    .header {
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h2 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    /* Form Search Styles */
    .mb-3 {
        margin-bottom: 20px;
    }

    .input-group {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        width: 100%;
    }

    .form-control {
        flex: 1;
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

    /* Button Styles */
    .btn {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        min-width: 100px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        margin-top: 10px;
    }

    .btn-secondary {
        background-color: rgb(165, 19, 22);
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary:hover {
        background-color: rgb(179, 0, 0);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(252, 6, 6, 0.3);
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead {
        background-color: #007bff;
    }

    .table th {
        padding: 14px 16px;
        font-weight: 600;
        text-align: center;
        border: 1px solid #dee2e6;
        color: black;
        background-color: rgb(168, 198, 36);
    }

    .table td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    /* Action Button Styles */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 5px;
    }

    .action-btn {
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
        text-decoration: none;
        color: white;
        display: inline-block;
        text-align: center;
        transition: all 0.2s ease;
    }

    .view-btn {
        background-color: #28a745;
    }

    .view-btn:hover {
        background-color: #218838;
    }

    .edit-btn {
        background-color: #ffc107;
        color: #212529;
    }

    .edit-btn:hover {
        background-color: #e0a800;
    }

    .delete-btn {
        background-color: #dc3545;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        list-style: none;
    }

    .pagination a,
    .pagination strong {
        padding: 8px 12px;
        margin: 2px;
        text-decoration: none;
        border: 1px solid #007bff;
        border-radius: 5px;
        color: #007bff;
        background-color: #fff;
        font-weight: bold;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: white;
    }

    .pagination strong {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }


    /* Responsive Styles */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header h2 {
            margin-bottom: 15px;
        }

        .input-group {
            flex-direction: column;
        }

        .form-control,
        .btn {
            width: 100%;
        }
    }
</style>

<div class="container">


    <div class="header">
        <h2>Daftar User</h2>
        <a href="/users/create" class="btn btn-primary">Tambah User</a>
    </div>

    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama, NIP, Jabatan, Peran..." value="<?= esc($_GET['search'] ?? '') ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['full_name']) ?></td>
                        <td><?= esc($user['nip']) ?></td>
                        <td><?= esc($user['jabatan']) ?></td>
                        <td><?= esc($user['role']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="/users/view/<?= esc($user['id']) ?>" class="action-btn view-btn">Lihat</a>
                                <a href="/users/edit/<?= esc($user['id']) ?>" class="action-btn edit-btn">Edit</a>
                                <a href="/users/delete/<?= esc($user['id']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="action-btn delete-btn">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>