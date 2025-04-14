<div class="sidebar">
    <h2>SARANA DAN PRASARANA</h2>
    <img src="<?= base_url('assets/images/logo_ppsdm.png'); ?>" alt="Logo Kantor" class="logo">

    <ul>
        <li><a href="<?= base_url('diklatguest'); ?>">Alumni Diklat</a></li>
        <li><a href="<?= base_url('/dashboard/guest'); ?>">e-Jurnal</a></li>
        <li><a href="<?= base_url('login'); ?>">Login</a></li>
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