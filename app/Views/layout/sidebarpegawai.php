<div class="sidebar">
    <h2>SARANA DAN PRASARANA</h2>
    <img src="<?= base_url('assets/images/logo_ppsdm.png'); ?>" alt="Logo Kantor" class="logo">

    <ul>
        <li><a href="<?= base_url('/dashboard'); ?>">Dashboard</a></li>

        <li class="dropdown">
            <a href="javascript:void(0);" onclick="toggleDropdown('inventaris')">
                Inventaris <i class="fas fa-chevron-down"></i>
            </a>
            <ul id="inventaris" class="submenu">
                <li><a href="<?= base_url('#'); ?>">Daftar Inventaris</a></li>
                <li><a href="<?= base_url('#'); ?>">Insert Inventaris</a></li>
                <li><a href="<?= base_url('#'); ?>">Riwayat Transaksi</a></li>
                <li><a href="<?= base_url('#'); ?>">Daftar Permintaan</a></li>
                <li><a href="<?= base_url('#'); ?>">Request Items</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="javascript:void(0);" onclick="toggleDropdown('aset')">
                Aset <i class="fas fa-chevron-down"></i>
            </a>
            <ul id="aset" class="submenu">
                <li><a href="<?= base_url('#'); ?>">Daftar Kategori Aset</a></li>
                <li><a href="<?= base_url('pegawai/peminjaman'); ?>">Peminjaman</a></li>
                <li><a href="<?= base_url('#'); ?>">Aset Rusak</a></li>
            </ul>
        </li>

        <li><a href="<?= base_url('#'); ?>">Inventaris</a></li>
        <li><a href="<?= base_url('#'); ?>">Insert Inventaris</a></li>
        <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
    </ul>
</div>

<script>
  function toggleDropdown(id) {
    var menu = document.getElementById(id);
    var parent = menu.parentElement;
    
    // Toggle class "active" untuk menampilkan atau menyembunyikan submenu
    parent.classList.toggle("active");
  }
</script>
