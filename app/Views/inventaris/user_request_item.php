<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

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
            <button type="button" onclick="addItem()">+</button>
        </div>
    </div>

    <button type="submit">Submit Request</button>
</form>

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
            <button type="button" onclick="removeItem(this)">x</button>
        `;
        document.getElementById('items').appendChild(newItem);
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>

<?= $this->endSection() ?>