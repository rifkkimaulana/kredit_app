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
$routes->setDefaultNamespace('App\Controllers\Auth');
$routes->setDefaultController('Login');
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


/**
 * --------------------------------------------------------------------
 * Meta RG Aplication - Routes Configuration
 * --------------------------------------------------------------------
 */


// Meta Panel
$routes->group('meta', ['namespace' => 'App\Controllers\Meta'], function ($routes) {
	//Meta Dashboard
	$routes->get('/', 'Dashboard::index');
	$routes->get('dashboard', 'Dashboard::index');

	// Meta Management Aplications
	$routes->get('app_management', 'Aplication::index');
	$routes->post('open/aplication', 'Aplication::sign_in');
	$routes->get('user_management', 'Users::index');
});
// END Meta Panel

// Routes For Kredit_App
$routes->group('', ['namespace' => 'App\Controllers\Kredit_App'], function ($routes) {

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

	// Produk Routes
	$routes->group('ka-produk', ['namespace' => 'App\Controllers\Kredit_App\Produk'], function ($routes) {
		// Produk
		$routes->get('produk', 'Produk::index');

		// Produk Management
		$routes->get('management_produk', 'Produk::management_produk');
		$routes->post('management_produk', 'Produk::produk_post');

		// Kategori Produk
		$routes->get('kategori', 'Produk::kategori_produk');
		$routes->post('kategori', 'Produk::kategori_post');
	});

	// Transaksi
	$routes->group('ka-transaksi', ['namespace' => 'App\Controllers\Kredit_App\Transaksi'], function ($routes) {

		// Transaksi Management
		$routes->get('transaksi', 'Transaksi::index');
		$routes->post('transaksi', 'Transaksi::transaksi_post');
		$routes->get('transaksi/d/(:num)', 'Transaksi::transaksi_delete/$1');
		$routes->post('transaksi/verifikasi', 'Transaksi::verifikasi');

		// Penjualan For Keranjang Belanja
		$routes->get('keranjang', 'Keranjang::index');
		$routes->post('keranjang', 'Keranjang::keranjang_insert');
		$routes->get('d/(:num)', 'Keranjang::keranjang_delete/$1');

		// Laporan Keuangan
		$routes->get('laporan', 'Laporan::index');
		$routes->get('laporan/filter', 'Laporan::filter');
		$routes->get('laporan/(:segment)', 'Laporan::cetak/$1');
	});

	// Paylater
	$routes->group('ka-paylater', ['namespace' => 'App\Controllers\Kredit_App\Paylater'], function ($routes) {

		//Kontrak View kontrak/delete
		$routes->get('kontrak', 'Kontrak::index');
		$routes->get('pembayaran', 'Pembayaran::index');
		$routes->post('pembayaran', 'Pembayaran::getHargaPembayaran');

		$routes->get('kontrak/delete/(:num)', 'Kontrak::deleteKontrak/$1');

		$routes->post('verifikasi', 'PayLater::verifikasiKontrak');

		$routes->post('pembayaran/confirm', 'Pembayaran::pembayaranInsert');

		$routes->get('pembayaran/confirm/(:num)', 'Pembayaran::pembayaranKonfirmasi/$1');
		$routes->get('pembayaran/delete/(:num)', 'Pembayaran::delete/$1');

		// Table Identitas Admin 
		$routes->get('peninjauan', 'Identitas::index');
		$routes->get('identitas/tolak/(:num)', 'Identitas::PeninjauanTolak/$1');
		$routes->get('identitas/terima/(:num)', 'Identitas::PeninjauanTerima/$1');
		$routes->get('identitas/delete/(:num)', 'Identitas::delete/$1');
	});

	// Log Aktifitas User
	$routes->get('log_aktivitas', 'Log::index');

	// End Session All
	$routes->get('logout', 'Dashboard::logout');

	// Access Denied
	$routes->get('access_denied', 'Dashboard::access_denied');
});
// End Kredit APP

// Auth Users
$routes->group('', ['namespace' => 'App\Controllers\Auth'], function ($routes) {

	// Autentikasi Users
	$routes->get('login', 'Login::index');
	$routes->post('login', 'Login::login_post');

	$routes->get('forgot-password', 'ForgotPassword::index');
	$routes->post('forgot-password', 'ForgotPassword::forgot_password_post');

	$routes->get('recovery/(:segment)', 'Recovery::index/$1');
	$routes->post('recovery', 'Recovery::recovery_post');

	// Sign With Whatsapp Number only OTP Code
	$routes->get('whatsapp', 'Whatsapp::index');
	$routes->post('whatsapp/send_otp', 'Whatsapp::signWhatsappNumber_post');
	$routes->get('login/(:segment)', 'Whatsapp::signWhatsappNumber_login/$1');

	$routes->get('register', 'Register::index');
	$routes->post('register', 'Register::register_post');

	$routes->get('google', 'Google::googleAuth');
	$routes->get('google/callback', 'Google::googleAuth_callback');
});
// End Auth Users


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
