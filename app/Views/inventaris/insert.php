<?= $this->include('layout/sidebar'); ?>
<h2>Masukkan Persediaan</h2> 
<form action="<?= site_url('inventaris/insert_items') ?>" method="post">
    <div id="items">
        <div class="item">
            <select name="items[0][id_barang]">
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="items[0][jumlah]" placeholder="Quantity" required>
            <input type="text" name="items[0][satuan]" placeholder="Unit">
            <button type="button" onclick="addItem()">+</button>
        </div>
    </div>

    <a type="submit" href="<?= base_url('inventaris/index'); ?>" >Submit</>
</form>

<script>
function addItem() {
    let index = document.querySelectorAll('.item').length; // Get current item count
    let newItem = document.createElement('div');
    newItem.classList.add('item');
    newItem.innerHTML = `
        <select name="items[${index}][id_barang]">
            <?php foreach ($items as $item): ?>
                <option value="<?= $item['id_barang']; ?>"><?= $item['nama_barang']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="items[${index}][jumlah]" placeholder="Quantity" required>
        <input type="text" name="items[${index}][satuan]" placeholder="Unit">
    `;
    document.getElementById('items').appendChild(newItem);
}
</script>




