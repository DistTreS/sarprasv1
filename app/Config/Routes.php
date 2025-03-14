<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'admin']);
$routes->get('/dashboard/pegawai', 'Dashboard::indexpegawai');
$routes->get('/dashboard/guest', 'Dashboard::indexguest');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/diklatguest', 'DiklatController::indexguest');
$routes->get('viewPesertaGuest/(:num)/(:num)', 'DiklatController::viewPesertaGuest/$1/$2');
$routes->get('diklat/lihatTugasAkhir/(:num)/(:num)', 'DiklatController::lihatTugasAkhir/$1/$2');


//gunakan filter untuk membedakan mana untuk admin mana untuk pegawai
//['filter' => 'admin'] -> ini fungsi filter untuk admin
//['filter' => 'pegawai'] -> ini fungsi untuk filter untuk pegawai
$routes->group('users', ['filter' => 'admin'],  function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('view/(:num)', 'UserController::view/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
});




// Modul Diklat
$routes->group('diklat', ['filter' => 'admin'], function ($routes) {
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


// Route untuk Admin
// Modul Peminjaman
$routes->get('kategoriAset', 'KategoriAsetController::index', ['filter' => 'admin']); // Menampilkan daftar kategori aset
$routes->get('kategoriAset/tambah', 'KategoriAsetController::tambah', ['filter' => 'admin']); // Form tambah kategori aset
$routes->post('kategoriAset/store', 'KategoriAsetController::store', ['filter' => 'admin']); // Proses simpan kategori aset
$routes->get('kategoriAset/detail/', 'AsetController::index/$1', ['filter' => 'admin']); // Menampilkan daftar aset berdasarkan kategori
$routes->post('kategoriAset/update/(:num)', 'KategoriAsetController::update/$1', ['filter' => 'admin']); // Proses update kategori aset
$routes->post('kategoriAset/delete/(:num)', 'KategoriAsetController::delete/$1', ['filter' => 'admin']); // Hapus kategori aset


$routes->get('aset', 'AsetController::index', ['filter' => 'admin']);  
$routes->get('aset/create', 'AsetController::create', ['filter' => 'admin']);  
$routes->post('aset/store', 'AsetController::store', ['filter' => 'admin']);    
$routes->post('aset/update/(:num)', 'AsetController::update/$1', ['filter' => 'admin']);  
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1', ['filter' => 'admin']);
$routes->post('aset/delete/(:num)', 'AsetController::delete/$1', ['filter' => 'admin']);  
$routes->get('aset/(:num)', 'AsetController::index/$1', ['filter' => 'admin']);  
$routes->get('aset/edit/(:num)', 'AsetController::edit/$1');

$routes->get('/peminjaman', 'PeminjamanController::index', ['filter' => 'admin']); // Menampilkan daftar peminjaman
$routes->get('/peminjaman/detail/(:num)', 'PeminjamanController::detail/$1', ['filter' => 'admin']); // Menampilkan detail peminjaman berdasarkan ID
$routes->get('peminjaman/riwayat', 'Peminjaman::riwayat', ['filter' => 'admin']); // Menampilkan riwayat peminjaman
$routes->post('peminjaman/update_status/(:num)', 'PeminjamanController::update_status/$1', ['filter' => 'admin']); // Mengubah status peminjaman
$routes->get('peminjaman/cetak/(:num)', 'PeminjamanController::cetak/$1', ['filter' => 'admin']); // Mencetak detail peminjaman
$routes->get('peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalianAdmin/$1', ['filter' => 'admin']); // Form pengembalian aset
$routes->post('peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'admin']); // Upload bukti pengembalian aset
$routes->post('peminjaman/setujui/(:num)', 'PeminjamanController::setujui/$1');
$routes->post('peminjaman/tolak/(:num)', 'PeminjamanController::tolak/$1');



$routes->get('aset_rusak', 'AsetRusakController::index', ['filter' => 'admin']); // Menampilkan daftar aset rusak
$routes->get('aset_rusak/create/(:num)', 'AsetRusakController::create/$1', ['filter' => 'admin']); // Form tambah aset rusak berdasarkan ID aset
$routes->post('aset_rusak/store', 'AsetRusakController::store', ['filter' => 'admin']); // Proses simpan aset rusak
$routes->get('aset-rusak/detail/(:num)', 'AsetRusakController::detail/$1', ['filter' => 'admin']); // Menampilkan detail aset rusak berdasarkan ID
$routes->get('aset_rusak/cetak/(:num)', 'AsetRusakController::cetak/$1', ['filter' => 'admin']); // Mencetak laporan aset rusak


// Route untuk Pegawai (User Biasa)
// Modul Peminjaman
$routes->get('aset-rusak/riwayat', 'AsetRusakController::riwayat', ['filter' => 'pegawai']);
$routes->get('aset-rusak/pengajuan', 'AsetRusakController::pengajuan', ['filter' => 'pegawai']);
$routes->post('aset-rusak/simpan', 'AsetRusakController::simpanPengajuan', ['filter' => 'pegawai']);
$routes->get('aset-rusak/detailpegawai/(:num)/(:num)', 'AsetRusakController::detailpegawai/$1/$2', ['filter' => 'pegawai']);

$routes->get('/pegawai/peminjaman', 'PeminjamanController::indexPegawai', ['filter' => 'pegawai']); // Menampilkan riwayat peminjaman pegawai
$routes->get('/pegawai/peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalianpegawai/$1', ['filter' => 'pegawai']); // Form pengembalian aset
$routes->post('/pegawai/peminjaman/uploadPengembalian/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'pegawai']); // Upload bukti pengembalian
$routes->get('/pegawai/peminjaman/ajukan', 'PeminjamanController::formPengajuan', ['filter' => 'pegawai']); // Form pengajuan peminjaman
$routes->post('/pegawai/peminjaman/simpan', 'PeminjamanController::simpanPengajuan', ['filter' => 'pegawai']);// Simpan pengajuan peminjaman
$routes->post('/pegawai/peminjaman/pengembalian/simpan/(:num)', 'PeminjamanController::uploadPengembalian/$1', ['filter' => 'pegawai']); // Simpan pengembalian
$routes->get('/pegawai/peminjaman/detail/(:num)', 'PeminjamanController::detailPengajuanPegawai/$1', ['filter' => 'pegawai']);


// ✅ Route untuk pegawai (melihat aset berdasarkan kategori)
$routes->get('pegawai/kategoriAset/detail/(:num)', 'AsetController::indexpegawai/$1', ['filter' => 'pegawai']);
$routes->get('pegawai/kategoriAset', 'KategoriAsetController::indexPegawai', ['filter' => 'pegawai']); // Menampilkan daftar kategori aset

$routes->get('peminjaman/cariAset/(:num)', 'AsetController::cariAset/$1', ['filter' => 'admin']);
$routes->get('peminjaman/cariAsetPegawai/(:num)', 'AsetController::cariAsetPegawai/$1', ['filter' => 'pegawai']);



//modul Inventaris
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
