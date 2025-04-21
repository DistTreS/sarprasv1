<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .requester-info select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    select, input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .item-info {
        flex: 1;
        font-weight: bold;
        color: #666;
    }

    button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .add-btn {
        background: #28a745;
        color: white;
        font-weight: bold;
    }

    .add-btn:hover {
        background: #218838;
    }

    .remove-btn {
        background: #dc3545;
        color: white;
        font-weight: bold;
    }

    .remove-btn:hover {
        background: #c82333;
    }

    .submit-btn {
        width: 100%;
        background: #007bff;
        color: white;
        font-size: 16px;
        padding: 12px;
        margin-top: 15px;
    }

    .submit-btn:hover {
        background: #0056b3;
    }
</style>

<div class="container">
    <h2>Form Permintaan Pembelian Barang</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <script>alert("<?= session()->getFlashdata('success'); ?>");</script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>alert("<?= session()->getFlashdata('error'); ?>");</script>
    <?php endif; ?>

    <form action="<?= site_url('pembelian/store') ?>" method="post">
        <div class="requester-info">
            <p><strong>Nama Peminta:</strong></p>
            <select name="nama_peminta" class="form-control select2" required>
                <option value="">Pilih Peminta</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['full_name']; ?>"><?= $user['full_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="items">
            <div class="item">
                <select name="items[0][id_barang]" class="select2-barang" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="items[0][jumlah]" placeholder="Jumlah" required>
                <button type="button" class="add-btn" onclick="addItem()">+</button>
            </div>
        </div>

        <button type="submit" class="submit-btn">Submit Permintaan Pembelian</button>
    </form>
</div>

<script>
function addItem() {
    const itemsDiv = document.getElementById('items');
    const itemCount = itemsDiv.children.length;

    const newItem = document.createElement('div');
    newItem.className = 'item';
    newItem.innerHTML = `
        <select name="items[${itemCount}][id_barang]" class="select2-barang" required>
            <option value="">Pilih Barang</option>
            <?php foreach ($items as $item): ?>
                <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="items[${itemCount}][jumlah]" placeholder="Jumlah" required>
        <button type="button" class="remove-btn" onclick="removeItem(this)">-</button>
    `;

    itemsDiv.appendChild(newItem);
    $('.select2-barang').select2(); // re-inisialisasi
}

function removeItem(button) {
    button.parentElement.remove();
}

$(document).ready(function() {
    $('.select2').select2({ placeholder: "Cari nama peminta...", allowClear: true });
    $('.select2-barang').select2({ placeholder: "Cari barang...", allowClear: true });
});
</script>

<?= $this->endSection() ?>
