<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

$routes->get('laporan_penjualan', 'CommingSoon::index');
$routes->get('pesanan', 'CommingSoon::index');
$routes->get('tagihan', 'CommingSoon::index');
$routes->get('bayar_angsuran', 'CommingSoon::index');

// Pembayaran Tagihan
$routes->get('pembayaran/tagihan', 'Pembayaran::index');
$routes->post('pembayaran/tambah', 'Pembayaran::pembayaranInsert');
$routes->get('pembayaran/konfirmasi/(:num)', 'Pembayaran::pembayaranKonfirmasi/$1');
$routes->get('pembayaran/delete/(:num)', 'Pembayaran::delete/$1');

// Log Aktifitas User
$routes->get('log_aktivitas', 'LogAktifitas::index');

// Produk Routes
$routes->get('produk/list', 'Produk::index');
$routes->post('produk/tambah', 'Produk::produk_postInsert');
$routes->post('produk/update', 'Produk::produk_postUpdate');
$routes->get('produk/delete/(:num)', 'Produk::deleteProduk/$1');

// Produk Routes - kategori
$routes->get('produk/kategori', 'Produk::kategori');
$routes->post('produk/kategori/insert', 'Produk::kategori_postInsert');
$routes->post('produk/kategori/update', 'Produk::kategori_postUpdate');
$routes->get('produk/kategori/delete/(:num)', 'Produk::deleteKategori/$1');


// Penjualan Barang
$routes->get('penjualan/list_penjualan', 'Penjualan::index');
$routes->get('penjualan/hapus/(:num)', 'Penjualan::hapusPenjualan/$1');
$routes->post('penjualan/verifikasi', 'Penjualan::verifikasi');

// Penjualan For Keranjang Belanja
$routes->post('keranjang', 'Penjualan::keranjang_addPost');
$routes->get('keranjang', 'Penjualan::keranjang');
$routes->post('penjualan/cekout', 'Penjualan::cekout');
$routes->get('keranjang/delete/(:num)', 'Penjualan::hapusProdukKeranjang/$1');

// Autentikasi Users
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('forgot-password', 'Auth::forgot_password');
$routes->post('forgot-password', 'Auth::forgot_password_post');
$routes->get('recovery/(:segment)', 'Auth::recovery_view/$1');
$routes->post('recovery', 'Auth::recovery_post');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register_post');

$routes->get('google', 'Auth::googleAuth');
$routes->get('google/callback', 'Auth::googleAuth_callback');

// Statistik Penjualan
$routes->get('penjualan/statistik', 'StatistikPenjualan::index');

// Dashboard Pages
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::index');

// Pengaturan menu
$routes->get('pengaturan/profile', 'Pengaturan::profile');
$routes->post('pengaturan/profile_update', 'Pengaturan::profilePostUpdate');

$routes->get('pengaturan/google_api', 'Pengaturan::settingApiGoogle');
$routes->post('pengaturan/google_api/update', 'Pengaturan::settingApiGoogle_post');

$routes->get('pengaturan/umum', 'Pengaturan::pengaturan');
$routes->post('pengaturan/umum/update', 'Pengaturan::pengaturanPostUpdate');

$routes->get('pengaturan/users', 'Pengaturan::users');
$routes->post('pengaturan/users/update', 'Pengaturan::user_postUpdate');
$routes->get('pengaturan/users/delete/(:num)', 'Pengaturan::deleteUsers/$1');

$routes->get('pengaturan/whatsapp_api', 'Pengaturan::whatsappApiSetting');
$routes->post('pengaturan/whatsapp_api/update', 'Pengaturan::whatsappApiSetting_update');

// End Session All
$routes->get('logout', 'Home::logout');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
