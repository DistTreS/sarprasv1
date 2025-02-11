<?= $this->include('layout/sidebar'); ?>
<h2>Masukkan Persediaan</h2> 
<form action="<?= site_url('inventory/insert') ?>" method="post">
    <div id="items">
        <div class="item">
            <input type="text" name="items[0][name]" placeholder="Item Name" required>
            <input type="number" name="items[0][quantity]" placeholder="Quantity" required>
            <input type="text" name="items[0][unit]" placeholder="Unit">
            <button type="button" onclick="addItem()">+</button>
        </div>
    </div>
    <button type="submit">Insert Items</button>
</form>

<script>
    let count = 1;
    function addItem() {
        let itemDiv = document.createElement("div");
        itemDiv.className = "item";
        itemDiv.innerHTML = `<input type="text" name="items[${count}][name]" placeholder="Item Name" required>
            <input type="number" name="items[${count}][quantity]" placeholder="Quantity" required>
            <input type="text" name="items[${count}][unit]" placeholder="Unit">
            <button type="button" onclick="this.parentElement.remove()">-</button>`;
        document.getElementById("items").appendChild(itemDiv);
        count++;
    }
</script>
