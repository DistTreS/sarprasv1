<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/dashboard', 'Dashboard::index');

//modul latsar
$routes->get('/pesertaLatsar', 'PesertaLatsar::index');
$routes->get('/pesertaLatsar/create', 'PesertaLatsar::create');
$routes->post('/pesertaLatsar/store', 'PesertaLatsar::store');
$routes->get('/pesertaLatsar/view/(:num)', 'PesertaLatsar::view/$1');
$routes->get('/pesertaLatsar/edit/(:num)', 'PesertaLatsar::edit/$1');
$routes->post('/pesertaLatsar/update/(:num)', 'PesertaLatsar::update/$1');
$routes->get('/pesertaLatsar/delete/(:num)', 'PesertaLatsar::delete/$1');
$routes->post('pesertaLatsar/importExcel', 'PesertaLatsar::importExcel');


//modul inventory


//modul pinjam barang
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





























