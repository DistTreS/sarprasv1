<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'multi_admin']);
$routes->get('/dashboard/pegawai', 'Dashboard::indexpegawai', ['filter' => 'pegawai']);
$routes->get('/dashboard/guest', 'Dashboard::indexguest');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/diklatguest', 'DiklatController::indexguest');
$routes->get('viewPesertaGuest/(:num)/(:num)', 'DiklatController::viewPesertaGuest/$1/$2');
$routes->get('diklat/lihatTugasAkhir/(:num)/(:num)', 'DiklatController::lihatTugasAkhir/$1/$2');
$routes->get('/profil', 'ProfilController::profile');
$routes->get('/profil/pegawai', 'ProfilController::profilePegawai');
$routes->get('/profile/edit', 'ProfilController::editProfile');
$routes->get('/profilepegawai/edit', 'ProfilController::editProfilePegawai');
$routes->post('/profile/update', 'ProfilController::update');
$routes->post('/profilepegawai/update', 'ProfilController::updatePegawai');




//gunakan filter untuk membedakan mana untuk admin_utama mana untuk pegawai
//['filter' => 'admin_utama'] -> ini fungsi filter untuk admin_utama
//['filter' => 'pegawai'] -> ini fungsi untuk filter untuk pegawai
$routes->group('users', ['filter' => 'admin_utama'],  function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('view/(:num)', 'UserController::view/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
});




// Modul Diklat
$routes->group('diklat', ['filter' => 'admin_diklat'], function ($routes) {
    $routes->get('/', 'DiklatController::index'); // Halaman utama daftar peserta diklat
    $routes->get('cekPesertaByNip/(:any)', 'DiklatController::cekPesertaByNip/$1');
    $routes->get('viewPeserta/(:num)/(:num)', 'DiklatController::viewPeserta/$1/$2'); // Lihat detail peserta
    $routes->get('editPeserta/(:num)/(:num)', 'DiklatController::editPeserta/$1/$2'); // Edit peserta
    $routes->post('updatePeserta/(:num)/(:num)', 'DiklatController::updatePeserta/$1/$2'); // Update peserta
    $routes->get('tambahPeserta', 'DiklatController::tambahPeserta'); // Form tambah peserta
    $routes->post('tambahPeserta', 'DiklatController::tambahPeserta'); // Simpan peserta baru
    $routes->post('importPeserta', 'DiklatController::importPeserta'); // Import peserta dari Excel
    $routes->get('hapusPeserta/(:num)/(:num)', 'DiklatController::hapusPeserta/$1/$2'); // Hapus peserta
    $routes->post('importExcel', 'DiklatController::importExcel');
    $routes->get('exportToPdf', 'DiklatController::exportToPdf');


    // Jenis Diklat
    $routes->get('jenisDiklat', 'DiklatController::jenisDiklat'); // Halaman utama jenis diklat
    $routes->get('tambahJenisDiklat', 'DiklatController::tambahJenisDiklat'); // Form tambah jenis diklat
    $routes->post('simpanJenisDiklat', 'DiklatController::simpanJenisDiklat'); // Simpan jenis diklat baru
    $routes->get('editJenisDiklat/(:num)', 'DiklatController::editJenisDiklat/$1'); // Form edit jenis diklat
    $routes->post('updateJenisDiklat/(:num)', 'DiklatController::updateJenisDiklat/$1'); // Update jenis diklat
    $routes->get('hapusJenisDiklat/(:num)', 'DiklatController::hapusJenisDiklat/$1'); // Hapus jenis diklat
});



// Modul Peminjaman
$routes->get('kategoriAset', 'KategoriAsetController::index', ['filter' => 'admin_utama']); // Menampilkan daftar kategori aset
$routes->get('kategoriAset/tambah', 'KategoriAsetController::tambah', ['filter' => 'admin_utama']); // Form tambah kategori aset
$routes->post('kategoriAset/store', 'KategoriAsetController::store', ['filter' => 'admin_utama']); // Proses simpan kategori aset
$routes->get('kategoriAset/detail/', 'AsetController::index/$1', ['filter' => 'admin_utama']); // Menampilkan daftar aset berdasarkan kategori
$routes->post('kategoriAset/update/(:num)', 'KategoriAsetController::update/$1', ['filter' => 'admin_utama']); // Proses update kategori aset
$routes->post('kategoriAset/delete/(:num)', 'KategoriAsetController::delete/$1', ['filter' => 'admin_utama']); // Hapus kategori aset

$routes->get('aset', 'AsetController::index', ['filter' => 'admin_peminjaman']);
$routes->get('aset/create', 'AsetController::create', ['filter' => 'admin_peminjaman']);
$routes->post('aset/store', 'AsetController::store', ['filter' => 'admin_peminjaman']);
$routes->post('aset/update', 'AsetController::update', ['filter' => 'admin_peminjaman']);

$routes->get('aset/edit/(:num)', 'AsetController::edit/$1', ['filter' => 'admin_peminjaman']);
$routes->post('aset/delete/(:num)', 'AsetController::delete/$1', ['filter' => 'admin_peminjaman']);
$routes->get('aset/(:num)', 'AsetController::index/$1', ['filter' => 'admin_peminjaman']);

$routes->get('peminjaman', 'PeminjamanController::index', ['filter' => 'admin_peminjaman']); // Menampilkan daftar peminjaman
$routes->get('peminjaman/detail/(:segment)', 'PeminjamanController::detail/$1', ['filter' => 'admin_peminjaman']); // Menampilkan detail peminjaman berdasarkan id pengajuan
$routes->get('peminjaman/riwayat', 'Peminjaman::riwayat', ['filter' => 'admin_peminjaman']); // Menampilkan riwayat peminjaman
$routes->post('peminjaman/update_status/(:segment)', 'PeminjamanController::update_status/$1', ['filter' => 'admin_peminjaman']); // Mengubah status peminjaman
$routes->get('peminjaman/cetak/(:segment)', 'PeminjamanController::cetak/$1', ['filter' => 'admin_peminjaman']); // Mencetak detail peminjaman
$routes->get('peminjaman/pengembalian/(:segment)', 'PeminjamanController::pengembalianAdmin/$1', ['filter' => 'admin_peminjaman']); // Form pengembalian aset
$routes->post('peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'admin_peminjaman']); // Upload bukti pengembalian aset
$routes->post('peminjaman/setujui/(:segment)', 'PeminjamanController::setujui/$1');
$routes->post('peminjaman/tolak/(:segment)', 'PeminjamanController::tolak/$1');
$routes->get('peminjaman/ajukan', 'PeminjamanController::formPengajuanAdmin', ['filter' => 'admin_peminjaman']); // Form pengajuan peminjaman
$routes->post('peminjaman/simpan', 'PeminjamanController::simpanPengajuanAdmin', ['filter' => 'admin_peminjaman']); // Simpan pengajuan peminjaman


$routes->get('aset_rusak', 'AsetRusakController::index', ['filter' => 'admin_peminjaman']); // Menampilkan daftar aset rusak
$routes->get('aset_rusak/create/(:num)', 'AsetRusakController::create/$1', ['filter' => 'admin_peminjaman']); // Form tambah aset rusak berdasarkan ID aset
$routes->post('aset_rusak/store', 'AsetRusakController::store', ['filter' => 'admin_peminjaman']); // Proses simpan aset rusak
$routes->get('aset-rusak/detail/(:num)/(:num)', 'AsetRusakController::detail/$1/$2', ['filter' => 'admin_peminjaman']); // Menampilkan detail aset rusak berdasarkan ID
$routes->get('aset_rusak/cetak/(:num)', 'AsetRusakController::cetak/$1', ['filter' => 'admin_peminjaman']); // Mencetak laporan aset rusak
$routes->get('aset-rusak/pengajuanadmin', 'AsetRusakController::pengajuanAdmin', ['filter' => 'admin_peminjaman']);
$routes->post('aset-rusak/simpanadmin', 'AsetRusakController::simpanPengajuanAdmin', ['filter' => 'admin_peminjaman']);

// Route untuk Pegawai (User Biasa)
// Modul Peminjaman
$routes->get('aset-rusak/riwayat', 'AsetRusakController::riwayat', ['filter' => 'pegawai']);
$routes->get('aset-rusak/pengajuan', 'AsetRusakController::pengajuan', ['filter' => 'pegawai']);
$routes->post('aset-rusak/simpan', 'AsetRusakController::simpanPengajuan', ['filter' => 'pegawai']);
$routes->get('aset-rusak/detailpegawai/(:num)/(:num)', 'AsetRusakController::detailpegawai/$1/$2', ['filter' => 'pegawai']);

$routes->get('/pegawai/peminjaman', 'PeminjamanController::indexPegawai', ['filter' => 'pegawai']); // Menampilkan riwayat peminjaman pegawai
$routes->get('/pegawai/peminjaman/pengembalian/(:segment)', 'PeminjamanController::pengembalianpegawai/$1', ['filter' => 'pegawai']);
$routes->post('/pegawai/peminjaman/uploadPengembalian/(:segment)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'pegawai']); // Upload bukti pengembalian
$routes->get('/pegawai/peminjaman/ajukan', 'PeminjamanController::formPengajuan', ['filter' => 'pegawai']); // Form pengajuan peminjaman
$routes->post('/pegawai/peminjaman/simpan', 'PeminjamanController::simpanPengajuan', ['filter' => 'pegawai']); // Simpan pengajuan peminjaman
$routes->post('/pegawai/peminjaman/pengembalian/simpan/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'pegawai']); // Simpan pengembalian
$routes->get('/pegawai/peminjaman/detail/(:segment)', 'PeminjamanController::detailPengajuanPegawai/$1', ['filter' => 'pegawai']);


// ✅ Route untuk pegawai (melihat aset berdasarkan kategori)
$routes->get('pegawai/kategoriAset/detail/(:num)', 'AsetController::indexpegawai/$1', ['filter' => 'pegawai']);
$routes->get('pegawai/kategoriAset', 'KategoriAsetController::indexPegawai', ['filter' => 'pegawai']); // Menampilkan daftar kategori aset

$routes->get('peminjaman/cariAset/(:num)', 'AsetController::cariAset/$1', ['filter' => 'admin_peminjaman']);
$routes->get('peminjaman/cariAsetPegawai/(:num)', 'AsetController::cariAsetPegawai/$1', ['filter' => 'pegawai']);



//modul Inventaris
$routes->get('inventaris/cetak', 'inventaris::cetak');
$routes->get('/inventaris/index', 'inventaris::index');
$routes->get('/inventaris/index_pegawai', 'inventaris::index_pegawai');
$routes->get('/inventaris/create', 'Inventaris::create');
$routes->post('/inventaris/store', 'Inventaris::store');
$routes->get('/inventaris/edit/(:num)', 'Inventaris::edit/$1');
$routes->post('/inventaris/update/(:num)', 'Inventaris::update/$1');
$routes->get('/inventaris/delete/(:num)', 'Inventaris::delete/$1');
$routes->get('/inventaris/insert', 'inventaris::insert');
$routes->post('inventaris/insert_items', 'Inventaris::insert_items');
$routes->get('inventaris/transaction_history', 'Inventaris::transaction_history');
$routes->get('inventaris/item_history/(:num)', 'Inventaris::item_history/$1');
$routes->get('inventaris/submit_request', 'Inventaris::submit_request');
$routes->post('inventaris/submit_request', 'Inventaris::submit_request'); // Submit request
$routes->post('inventaris/update_request_status/(:num)', 'Inventaris::updateRequestStatus/$1'); // Update request status
$routes->get('inventaris/request_history/(:num)', 'Inventaris::viewRequestHistory/$1'); // View request history
$routes->get('inventaris/user_request_item', 'Inventaris::user_request_item'); // User request form
$routes->post('inventaris/store_request', 'Inventaris::store_request'); // Handle request submission
$routes->get('inventaris/manage_request', 'Inventaris::manage_request'); // Admin_utama view
$routes->get('inventaris/process_request/(:num)/(:alpha)', 'Inventaris::process_request/$1/$2'); // Accept/Reject request
$routes->post('inventaris/update_status/(:num)', 'Inventaris::update_status/$1');










//modul pinjam barang
$routes->get('kategoriAset', 'KategoriAsetController::index'); // Menampilkan daftar kategori aset
$routes->get('kategoriAset/tambah', 'KategoriAsetController::tambah'); // Form tambah kategori aset
$routes->post('kategoriAset/store', 'KategoriAsetController::store'); // Proses simpan kategori aset
$routes->get('kategoriAset/detail/(:num)', 'AsetController::index/$1'); // Menampilkan daftar aset berdasarkan kategori
$routes->post('kategoriAset/update', 'KategoriAsetController::update');
$routes->get('kategoriAset/delete/(:segment)', 'KategoriAsetController::delete/$1');


$routes->get('aset', 'AsetController::index');
$routes->get('aset/create', 'AsetController::create');
$routes->post('aset/store', 'AsetController::store');
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1');
$routes->post('aset/update/(:num)', 'AsetController::update/$1');
$routes->get('aset/delete/(:num)', 'AsetController::delete/$1');



$routes->get('laporan/cetak', 'LaporanController::cetak');

$routes->group('pembelian', function($routes) {
    $routes->get('create', 'PembelianController::create');
    $routes->post('store', 'PembelianController::store');
    $routes->get('daftar', 'PembelianController::daftar');
    $routes->post('update_status/(:num)', 'PembelianController::update_status/$1');
});