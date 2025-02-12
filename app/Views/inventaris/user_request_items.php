<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Items</title>
</head>
<body>
    <h2>Request Items</h2>
    <?php if (session()->has('success')): ?>
        <p style="color: green;"><?= session('success'); ?></p>
    <?php elseif (session()->has('error')): ?>
        <p style="color: red;"><?= session('error'); ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('inventaris/submit_request'); ?>">
        <label for="nama_peminta">Your Name:</label>
        <input type="text" name="nama_peminta" required><br><br>

        <h4>Select Items:</h4>
        <div id="item-container">
            <div class="item-row">
                <select name="items[0][id_barang]" required>
                    <option value="">-- Select Item --</option>
                    <?php foreach ($persediaan as $item): ?>
                        <option value="<?= $item['id_barang']; ?>"><?= esc($item['nama_barang']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="items[0][jumlah]" min="1" placeholder="Quantity" required>
                <button type="button" onclick="removeItem(this)">Remove</button>
            </div>
        </div>

        <button type="button" onclick="addItem()">Add Another Item</button><br><br>
        <button type="submit">Submit Request</button>
    </form>

    <script>
        let itemIndex = 1;
        function addItem() {
            let container = document.getElementById('item-container');
            let newRow = document.createElement('div');
            newRow.classList.add('item-row');
            newRow.innerHTML = `
                <select name="items[${itemIndex}][id_barang]" required>
                    <option value="">-- Select Item --</option>
                    <?php foreach ($persediaan as $item): ?>
                        <option value="<?= $item['id_barang']; ?>"><?= esc($item['nama_barang']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="items[${itemIndex}][jumlah]" min="1" placeholder="Quantity" required>
                <button type="button" onclick="removeItem(this)">Remove</button>
            `;
            container.appendChild(newRow);
            itemIndex++;
        }

        function removeItem(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
