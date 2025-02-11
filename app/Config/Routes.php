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


$routes->get('aset', 'AsetController::index');
$routes->get('aset/create', 'AsetController::create');
$routes->post('aset/store', 'AsetController::store');
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1');
$routes->post('aset/update/(:num)', 'AsetController::update/$1');
$routes->get('aset/delete/(:num)', 'AsetController::delete/$1');















