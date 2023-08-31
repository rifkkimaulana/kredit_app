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

$routes->get('email_setting', 'CommingSoon::index');

$routes->get('laporan_penjualan', 'CommingSoon::index');
$routes->get('pesanan', 'CommingSoon::index');
$routes->get('tagihan', 'CommingSoon::index');
$routes->get('bayar_angsuran', 'CommingSoon::index');
$routes->get('riwayat_pembayaran', 'CommingSoon::index');

// Log Aktifitas User
$routes->get('log_aktivitas', 'LogAktifitas::index');

// Produk Routes
$routes->get('produk', 'Produk::index');
$routes->post('produk/tambah', 'Produk::produk_postInsert');
$routes->post('produk/update', 'Produk::produk_postUpdate');
$routes->get('produk/delete/(:num)', 'Produk::deleteProduk/$1');

// Kategori Produk Routes
$routes->get('produk/kategori', 'Produk::kategori');
$routes->post('produk/kategori', 'Produk::kategori_postInsert');
$routes->get('produk/kategori/delete/(:num)', 'Produk::deleteKategori/$1');


// Penjualan Barang
$routes->get('penjualan', 'Penjualan::index');
$routes->get('penjualan/hapus/(:num)', 'Penjualan::hapusPenjualan/$1');

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
$routes->get('statistik', 'StatistikPenjualan::index');

$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Home::index');
$routes->get('setting/google_api', 'Home::settingApiGoogle');
$routes->post('setting/google_api', 'Home::settingApiGoogle_post');

$routes->get('profile', 'Home::profile');
$routes->post('profile', 'Home::userProfile_postUpdate');

$routes->get('pengaturan', 'Home::pengaturan');
$routes->post('pengaturan', 'Home::pengaturan_post');
$routes->get('users', 'Home::users');
$routes->post('users', 'Home::user_postUpdate');
$routes->get('users/delete/(:num)', 'Home::deleteUsers/$1');

$routes->get('whatsapp_api_setting', 'Home::whatsappApiSetting');
$routes->post('whatsapp_api_setting', 'Home::whatsappApiSetting_update');

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
