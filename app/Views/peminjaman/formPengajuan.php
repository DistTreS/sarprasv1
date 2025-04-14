<?= $this->extend('layout/mainpegawai') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Ajukan Peminjaman Aset</h2>

    <form action="<?= base_url('pegawai/peminjaman/simpan') ?>" method="post">
        <label for="tanggal_peminjaman">Tanggal Pengajuan:</label>
        <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" required>

        <label for="tanggal_rencana_pengembalian">Tanggal Rencana Pengembalian:</label>
        <input type="date" name="tanggal_rencana_pengembalian" id="tanggal_rencana_pengembalian" required>

        <label>Pilih Aset:</label>
        <table id="tabel-aset" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Nama Aset</th>
                    <th>NUP</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asetList as $aset): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="id_aset[]" value="<?= esc($aset['id_aset']); ?>">
                        </td>
                        <td><?= esc($aset['nama_aset']); ?></td>
                        <td><?= esc($aset['nup']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



        <label for="CC">CC (Carbon Copy):</label>
        <input type="text" name="CC" id="CC" placeholder="Masukkan email CC (opsional)">

        <label for="keterangan">Keterangan:</label>
        <textarea name="keterangan" id="keterangan" rows="4" placeholder="Tambahkan keterangan peminjaman"></textarea>

        <div class="button-group">
            <button type="button" onclick="history.back()" class="btn-back">Kembali</button>
            <button type="submit">Ajukan Peminjaman</button>
        </div>
    </form>
</div>

<!-- Tambahkan jQuery dan DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabel-aset').DataTable({
            "paging": true, // Aktifkan paginasi
            "searching": true, // Aktifkan pencarian
            "ordering": false, // Matikan fitur sorting agar tetap sesuai urutan database
            "pageLength": 10 // Tampilkan 10 data per halaman
        });
    });
</script>

<style>
    /* Container Styling */
    .container {
        padding: 40px;
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* Heading Styles */
    h2 {
        color: #2c3e50;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
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
        background: #007bff;
        border-radius: 2px;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 25px;
    }

    /* Label Styling */
    label {
        display: block;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 15px;
    }

    /* Input Fields Styling */
    input[type="date"],
    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1.5px solid #e1e8ef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    /* Select Specific Styling */
    select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    /* Textarea Specific Styling */
    textarea {
        min-height: 120px;
        resize: vertical;
    }

    /* Focus States */
    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        background: #ffffff;
    }

    /* Button Styling */
    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .button-group button {
        flex: 1;
        padding: 14px;
        font-size: 16px;
        font-weight: 500;
        border: none;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Tombol Kembali */
    .btn-back {
        background-color: #6c757d;
        color: white;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.2);
    }

    .btn-back:hover {
        background-color: #5a6268;
        box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
        transform: translateY(-2px);
    }

    /* Tombol Ajukan (submit) */
    .button-group button[type="submit"] {
        background-color: #007bff;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }

    .button-group button[type="submit"]:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        transform: translateY(-2px);
    }


    /* Placeholder Styling */
    ::placeholder {
        color: #a0aec0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px 15px;
        }

        h2 {
            font-size: 24px;
        }

        input[type="date"],
        input[type="text"],
        select,
        textarea {
            font-size: 16px;
            /* Better for mobile */
        }
    }

    /* Optional Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    form {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>
<?= $this->endSection() ?>