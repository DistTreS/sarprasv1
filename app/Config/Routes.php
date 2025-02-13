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

// Modul Peminjaman
$routes->get('kategoriAset', 'KategoriAsetController::index', ['filter' => 'admin']); // Menampilkan daftar kategori aset
$routes->get('kategoriAset/tambah', 'KategoriAsetController::tambah', ['filter' => 'admin']); // Form tambah kategori aset
$routes->post('kategoriAset/store', 'KategoriAsetController::store', ['filter' => 'admin']); // Proses simpan kategori aset
$routes->get('kategoriAset/detail/(:num)', 'AsetController::index/$1', ['filter' => 'admin']); // Menampilkan daftar aset berdasarkan kategori
$routes->post('kategoriAset/update', 'KategoriAsetController::update', ['filter' => 'admin']); // Proses update kategori aset
$routes->post('kategoriAset/delete/(:segment)', 'KategoriAsetController::delete/$1', ['filter' => 'admin']); // Hapus kategori aset
$routes->get('/kategori-aset', 'KategoriAsetController::indexWithCount', ['filter' => 'admin']); // Menampilkan kategori aset dengan jumlah aset di dalamnya

$routes->get('aset', 'AsetController::index', ['filter' => 'admin']);  // Menampilkan semua aset
$routes->get('aset/create', 'AsetController::create', ['filter' => 'admin']); // Form tambah aset
$routes->post('aset/store', 'AsetController::store', ['filter' => 'admin']); // Simpan aset baru
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1', ['filter' => 'admin']); // Form edit aset
$routes->post('aset/update', 'AsetController::update', ['filter' => 'admin']); // Proses update aset
$routes->post('aset/delete/(:num)', 'AsetController::delete/$1', ['filter' => 'admin']); // Hapus aset berdasarkan ID
$routes->get('aset/(:num)', 'AsetController::index/$1', ['filter' => 'admin']); // Menampilkan aset berdasarkan kategori
$routes->put('aset/update/(:num)', 'AsetController::update/$1', ['filter' => 'admin']); // Update aset menggunakan metode PUT
$routes->patch('aset/update/(:num)', 'AsetController::update/$1', ['filter' => 'admin']); // Update aset menggunakan metode PATCH

$routes->get('/peminjaman', 'PeminjamanController::index', ['filter' => 'admin']); // Menampilkan daftar peminjaman
$routes->get('/peminjaman/detail/(:num)', 'PeminjamanController::detail/$1', ['filter' => 'admin']); // Menampilkan detail peminjaman berdasarkan ID
$routes->get('peminjaman/riwayat', 'Peminjaman::riwayat', ['filter' => 'admin']); // Menampilkan riwayat peminjaman
$routes->post('peminjaman/update_status/(:num)', 'PeminjamanController::update_status/$1', ['filter' => 'admin']); // Mengubah status peminjaman
$routes->get('peminjaman/cetak/(:num)', 'PeminjamanController::cetak/$1', ['filter' => 'admin']); // Mencetak detail peminjaman
$routes->get('peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalian/$1', ['filter' => 'admin']); // Form pengembalian aset
$routes->post('peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'admin']); // Upload bukti pengembalian aset

// Route untuk Pegawai (User Biasa)
$routes->get('/pegawai/peminjaman', 'PeminjamanController::indexPegawai', ['filter' => 'pegawai']); // Menampilkan riwayat peminjaman pegawai
$routes->get('/pegawai/peminjaman/detail/(:num)', 'PeminjamanController::detail/$1', ['filter' => 'pegawai']); // Detail peminjaman pegawai
$routes->get('/pegawai/peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalian/$1', ['filter' => 'pegawai']); // Form pengembalian aset
$routes->post('/pegawai/peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'pegawai']); // Upload bukti pengembalian
$routes->get('/pegawai/peminjaman/ajukan', 'PeminjamanController::formPengajuan', ['filter' => 'pegawai']); // Form pengajuan peminjaman
$routes->post('/pegawai/peminjaman/simpan', 'PeminjamanController::simpanPengajuan', ['filter' => 'pegawai']); // Simpan pengajuan peminjaman

$routes->get('aset_rusak', 'AsetRusakController::index', ['filter' => 'admin']); // Menampilkan daftar aset rusak
$routes->get('aset_rusak/create/(:num)', 'AsetRusakController::create/$1', ['filter' => 'admin']); // Form tambah aset rusak berdasarkan ID aset
$routes->post('aset_rusak/store', 'AsetRusakController::store', ['filter' => 'admin']); // Proses simpan aset rusak
$routes->get('aset-rusak/detail/(:num)', 'AsetRusakController::detail/$1', ['filter' => 'admin']); // Menampilkan detail aset rusak berdasarkan ID
$routes->get('aset_rusak/cetak/(:num)', 'AsetRusakController::cetak/$1', ['filter' => 'admin']); // Mencetak laporan aset rusak


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
