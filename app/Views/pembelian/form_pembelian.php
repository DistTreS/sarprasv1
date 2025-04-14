<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

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
