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
$routes->get('/inventaris', 'inventaris::index');
$routes->get('/inventaris/create', 'Inventaris::create');
$routes->post('/inventaris/store', 'Inventaris::store');
$routes->get('/inventaris/edit/(:num)', 'Inventaris::edit/$1');
$routes->post('/inventaris/update/(:num)', 'Inventaris::update/$1');
$routes->get('/inventaris/delete/(:num)', 'Inventaris::delete/$1');
$routes->get('/inventaris', 'Inventaris::insert');
=======


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

