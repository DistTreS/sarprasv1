<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>


<h2>Masukkan Persediaan</h2>

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
        <form action="<?= site_url('inventaris/insert_items') ?>" method="post">
            <div id="items">
                <div class="item">
                <select name="items[0][id_barang]" class="form-control select2-barang" onchange="updateInfo(this, 0)" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item['id_barang']; ?>"
                            data-jumlah="<?= $item['sisa']; ?>"
                            data-satuan="<?= $item['satuan']; ?>">
                            <?= $item['nama_barang']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    <input type="number" name="items[0][jumlah]" placeholder="Jumlah" required>
                    <button type="button" class="add-btn" onclick="addItem()">+</button>
                </div>
            </div>
            <!-- Tempat menampilkan info -->
<span id="info-0" class="item-info" style="margin-left: 10px; font-weight: bold;"></span>

            <button type="submit" class="submit-btn">Simpan</button>
        </form>
    </div>

<script>
    let itemOptions = `<?php foreach ($items as $item): ?>
        <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
    <?php endforeach; ?>`;

    function addItem() {
        let index = document.querySelectorAll('.item').length; // Get current item count
        let newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML = `
            <select name="items[${index}][id_barang]">${itemOptions}</select>
            <input type="number" name="items[${index}][jumlah]" placeholder="Jumlah" required>
            <button type="button" class="remove-btn" onclick="removeItem(this)">x</button>
        `;
        document.getElementById('items').appendChild(newItem);
    }

    function removeItem(button) {
        button.parentElement.remove(); // Removes the clicked item
    }
</script>

<script>
    $(document).ready(function() {
        $('.select2-barang').select2({
            placeholder: "Cari barang...",
            allowClear: true
        });
    });
</script>
<script>
function updateInfo(selectElem, index) {
    const selectedOption = selectElem.options[selectElem.selectedIndex];
    const jumlah = selectedOption.getAttribute('data-jumlah');
    const satuan = selectedOption.getAttribute('data-satuan');
    const infoElem = document.getElementById('info-' + index);

    if (jumlah && satuan) {
        infoElem.textContent = `Stok: ${jumlah} ${satuan}`;
    } else {
        infoElem.textContent = '';
    }
}
</script>
<?= $this->endSection() ?>




