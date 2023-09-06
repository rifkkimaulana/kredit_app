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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Meta RG Aplication - Routes Configuration
 * --------------------------------------------------------------------
 */
// Meta Panel
$routes->group('meta', ['namespace' => 'App\Controllers\Meta_RG_Controller'], function ($routes) {

	//Meta Dashboard
	$routes->get('/', 'Dashboard::index');
	$routes->get('dashboard', 'Dashboard::index');

	// Meta Management Aplications
	$routes->get('app_management', 'Aplication::index');
	$routes->post('open/aplication', 'Aplication::sign_in');


	$routes->get('user_management', 'Users::index');
});


/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

// Routes For Kredit_App
$routes->group('/', ['namespace' => 'App\Controllers\Kredit_App'], function ($routes) {
	// ka-dashboard
	$routes->get('/', 'Dashboard::index');
	$routes->get('ka-dashboard', 'Dashboard::index');

	// ka-settings - Profile
	$routes->group('ka-settings', ['namespace' => 'App\Controllers\Kredit_App\Settings'], function ($routes) {
		$routes->get('profile', 'Profile::index');
		$routes->post('profile', 'Profile::profile_update');

		$routes->get('app', 'App::index');
		$routes->post('app', 'App::app_update');

		$routes->get('users', 'Users::index');
		$routes->post('users', 'Users::user_update');
		$routes->get('users/(:num)', 'Users::user_delete/$1');

		$routes->get('google_api', 'GoogleApi::index');
		$routes->post('google_api', 'GoogleApi::GoogleApiUpdate');

		$routes->get('whatsapp_api', 'WhatsappApi::index');
		$routes->post('whatsapp_api', 'WhatsappApi::WhatsappApiUpdate');
	});

	// End Session All
	$routes->get('logout', 'Dashboard::logout');
});

// Pembayaran Tagihan 
$routes->get('paylater/tagihan', 'PayLater::index');
$routes->get('paylater/pendaftaran_kontrak', 'PayLater::formKontrakNew');
$routes->get('paylater/kontrak', 'PayLater::KontrakView');
$routes->post('paylater/tambah', 'PayLater::pembayaranInsert');
$routes->get('paylater/konfirmasi/(:num)', 'PayLater::pembayaranKonfirmasi/$1');
$routes->get('paylater/delete/(:num)', 'PayLater::delete/$1');
$routes->get('paylater/pendaftaran_kontrak/delete/(:num)', 'PayLater::hapusProdukKeranjang/$1');
$routes->post('paylater/keranjang/cekout', 'PayLater::cekoutPembayaranPaylater');
$routes->post('paylater/kontrak/verifikasi', 'PayLater::verifikasiPembelianPaylater');

// Log Aktifitas User
$routes->get('log_aktivitas', 'LogAktifitas::index');

// Produk Routes
$routes->get('produk/list', 'Produk::index');
$routes->get('produk/daftar', 'Produk::daftarProduk');
$routes->post('produk/tambah', 'Produk::produk_postInsert');
$routes->post('produk/update', 'Produk::produk_postUpdate');
$routes->get('produk/delete/(:num)', 'Produk::deleteProduk/$1');

// Produk Routes - kategori
$routes->get('produk/kategori', 'Produk::kategori');
$routes->post('produk/kategori/insert', 'Produk::kategori_postInsert');
$routes->post('produk/daftar/sent', 'Produk::sentProdukForKeranjangKredit');
$routes->post('produk/kategori/update', 'Produk::kategori_postUpdate');
$routes->get('produk/kategori/delete/(:num)', 'Produk::deleteKategori/$1');

// Penjualan Barang
$routes->get('transaksi/list_order', 'Penjualan::index');
$routes->get('penjualan/hapus/(:num)', 'Penjualan::hapusPenjualan/$1');
$routes->post('penjualan/verifikasi', 'Penjualan::verifikasi');

// Penjualan For Keranjang Belanja
$routes->post('transaksi/keranjang', 'Penjualan::keranjang_addPost');
$routes->get('transaksi/keranjang', 'Penjualan::keranjang');
$routes->post('penjualan/cekout', 'Penjualan::cekout');
$routes->get('keranjang/delete/(:num)', 'Penjualan::hapusProdukKeranjang/$1');

// Autentikasi Users
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('forgot-password', 'Auth::forgot_password');
$routes->post('forgot-password', 'Auth::forgot_password_post');
$routes->get('recovery/(:segment)', 'Auth::recovery_view/$1');
$routes->post('recovery', 'Auth::recovery_post');

// Identitas User Add
$routes->get('identitas', 'IdentitasController::index');
$routes->post('identitas/create', 'IdentitasController::simpanData');
$routes->get('identitas/update', 'IdentitasController::UpdateIdentitas_view');
$routes->post('identitas/update', 'IdentitasController::UpdateIdentitas_post');

$routes->get('paylater/peninjauan', 'IdentitasController::Peninjauan_view');
$routes->get('paylater/peninjauan/tolak/(:segment)', 'IdentitasController::PeninjauanTolak/$1');
$routes->get('paylater/peninjauan/terima/(:segment)', 'IdentitasController::PeninjauanTerima/$1');

// Sign With Whatsapp Number only OTP Code
$routes->get('whatsapp', 'Auth::signWhatsappNumber');
$routes->post('whatsapp/send_otp', 'Auth::signWhatsappNumber_post');
$routes->get('login/(:segment)', 'Auth::signWhatsappNumber_login/$1');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register_post');

$routes->get('google', 'Auth::googleAuth');
$routes->get('google/callback', 'Auth::googleAuth_callback');

// Statistik Penjualan
$routes->get('penjualan/statistik', 'StatistikPenjualan::index');

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
