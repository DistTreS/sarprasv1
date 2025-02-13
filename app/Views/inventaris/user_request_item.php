<?= $this->extend('layout/mainpegawai') ?>

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

    .requester-info input {
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
    }

    select, input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
    <h2>Form Permintaan Barang</h2>
    <form action="<?= site_url('inventaris/submit_request') ?>" method="post">
        <!-- Requester Information -->
        <div class="requester-info">
            <input type="text" name="nama_peminta" placeholder="Nama Peminta" required>
        </div>

        <!-- Items Section -->
        <div id="items">
            <div class="item">
                <select name="items[0][id_barang]" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="items[0][jumlah]" placeholder="Jumlah" required>
                <button type="button" class="add-btn" onclick="addItem()">+</button>
            </div>
        </div>

        <button type="submit" class="submit-btn">Submit Request</button>
    </form>
</div>

<script>
    let itemOptions = `
        <option value="">Pilih Barang</option>
        <?php foreach ($items as $item): ?>
            <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
        <?php endforeach; ?>`;

    function addItem() {
        let index = document.querySelectorAll('.item').length;
        let newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML = `
            <select name="items[${index}][id_barang]" required>${itemOptions}</select>
            <input type="number" name="items[${index}][jumlah]" placeholder="Jumlah" required>
            <button type="button" class="remove-btn" onclick="removeItem(this)">x</button>
        `;
        document.getElementById('items').appendChild(newItem);
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>

<?= $this->endSection() ?>
