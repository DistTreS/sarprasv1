<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'admin']);
$routes->get('/dashboard/pegawai', 'Dashboard::indexpegawai');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');


//gunakan filter untuk membedakan mana untuk admin mana untuk pegawai
//['filter' => 'admin'] -> ini fungsi filter untuk admin
//['filter' => 'pegawai'] -> ini fungsi untuk filter untuk pegawai

// Modul Diklat
$routes->group('diklat', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'DiklatController::index'); // Halaman utama daftar peserta diklat

    // Peserta Diklat
    $routes->get('viewPeserta/(:num)', 'DiklatController::viewPeserta/$1'); // Lihat detail peserta
    $routes->get('editPeserta/(:num)', 'DiklatController::editPeserta/$1'); // Edit peserta
    $routes->post('updatePeserta/(:num)', 'DiklatController::updatePeserta/$1'); // Update peserta
    $routes->get('tambahPeserta', 'DiklatController::tambahPeserta'); // Form tambah peserta
    $routes->post('tambahPeserta', 'DiklatController::tambahPeserta'); // Simpan peserta baru
    $routes->post('importPeserta', 'DiklatController::importPeserta'); // Import peserta dari Excel
    $routes->get('hapusPeserta/(:num)', 'DiklatController::hapusPeserta/$1'); // Hapus peserta
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


$routes->get('kategoriAset', 'KategoriAsetController::index'); // Menampilkan daftar kategori aset
$routes->get('kategoriAset/tambah', 'KategoriAsetController::tambah'); // Form tambah kategori aset
$routes->post('kategoriAset/store', 'KategoriAsetController::store'); // Proses simpan kategori aset
$routes->get('kategoriAset/detail/(:num)', 'AsetController::index/$1'); // Menampilkan daftar aset berdasarkan kategori
$routes->post('kategoriAset/update', 'KategoriAsetController::update');
$routes->get('kategoriAset/delete/(:segment)', 'KategoriAsetController::delete/$1');
$routes->post('kategoriAset/delete/(:segment)', 'KategoriAsetController::delete/$1');
$routes->get('/kategori-aset', 'KategoriAsetController::indexWithCount');




$routes->get('aset', 'AsetController::index');  // Semua aset
$routes->get('aset/create', 'AsetController::create'); // Form tambah aset
$routes->post('aset/store', 'AsetController::store'); // Simpan aset baru
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1'); // Form edit aset
$routes->post('aset/update', 'AsetController::update'); // Proses update aset
$routes->post('aset/delete/(:num)', 'AsetController::delete/$1'); // Hapus aset (pakai DELETE)
$routes->get('aset/(:num)', 'AsetController::index/$1'); // Daftar aset berdasarkan kategori
// Opsional: Bisa pakai PATCH/PUT untuk update yang lebih RESTful
$routes->put('aset/update/(:num)', 'AsetController::update/$1'); // Jika ingin pakai PUT
$routes->patch('aset/update/(:num)', 'AsetController::update/$1'); // Jika ingin pakai PATCH



$routes->get('/peminjaman', 'PeminjamanController::index');
$routes->get('/peminjaman/detail/(:num)', 'PeminjamanController::detail/$1');
$routes->get('peminjaman/riwayat', 'Peminjaman::riwayat');
$routes->post('peminjaman/update_status/(:num)', 'PeminjamanController::update_status/$1');
$routes->get('peminjaman/cetak/(:num)', 'PeminjamanController::cetak/$1');
$routes->get('peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalian/$1');
$routes->post('peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1');


$routes->get('aset_rusak', 'AsetRusakController::index');
$routes->get('aset_rusak/create/(:num)', 'AsetRusakController::create/$1');
$routes->post('aset_rusak/store', 'AsetRusakController::store');
$routes->get('aset-rusak/detail/(:num)', 'AsetRusakController::detail/$1');
$routes->get('aset_rusak/cetak/(:num)', 'AsetRusakController::cetak/$1');


//modul Inventaris
$routes->get('/inventaris/index', 'inventaris::index');
$routes->get('/inventaris/create', 'Inventaris::create');
$routes->post('/inventaris/store', 'Inventaris::store');
$routes->get('/inventaris/edit/(:num)', 'Inventaris::edit/$1');
$routes->post('/inventaris/update/(:num)', 'Inventaris::update/$1');
$routes->get('/inventaris/delete/(:num)', 'Inventaris::delete/$1');
$routes->get('/inventaris/insert', 'inventaris::insert');
$routes->post('inventaris/insert_items', 'Inventaris::insert_items');
$routes->get('inventaris/transaction_history', 'Inventaris::transaction_history');
$routes->get('inventaris/item_history/(:num)', 'Inventaris::item_history/$1');
$routes->get('inventaris/user_request_items', 'Inventaris::userRequestItems'); // Form to request items
$routes->post('inventaris/submit_request', 'Inventaris::submitRequest'); // Submit request
$routes->get('inventaris/manage_requests', 'Inventaris::manageRequests'); // Admin view of requests
$routes->post('inventaris/update_request_status/(:num)', 'Inventaris::updateRequestStatus/$1'); // Update request status
$routes->get('inventaris/request_history/(:num)', 'Inventaris::viewRequestHistory/$1'); // View request history










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
