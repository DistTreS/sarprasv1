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

