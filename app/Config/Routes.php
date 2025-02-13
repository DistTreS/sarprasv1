<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/dashboard', 'Dashboard::index');

// Modul Diklat
$routes->group('diklat', function ($routes) {
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
$routes->post('inventaris/submit_request', 'Inventaris::submit_request'); // Submit request
$routes->post('inventaris/update_request_status/(:num)', 'Inventaris::updateRequestStatus/$1'); // Update request status
$routes->get('inventaris/request_history/(:num)', 'Inventaris::viewRequestHistory/$1'); // View request history
$routes->get('inventaris/user_request_item', 'Inventaris::user_request_item'); // User request form
$routes->post('inventaris/store_request', 'Inventaris::store_request'); // Handle request submission
$routes->get('inventaris/manage_request', 'Inventaris::manage_request'); // Admin view
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

