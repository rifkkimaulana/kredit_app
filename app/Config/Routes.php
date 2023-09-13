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

// Routes For SCC IMASNET
$routes->group('', ['namespace' => 'App\Controllers\Imasnet'], function ($routes) {
	$routes->get('im-dashboard', 'Dashboard::index');

	// Grup Manajemen Inventory
	$routes->group('im-inventory', ['namespace' => 'App\Controllers\Imasnet\Inventory'], function ($routes) {

		$routes->get('inventory', 'Inventory::index');
		$routes->post('inventory/create', 'Inventory::create');
		$routes->post('inventory/update', 'Inventory::update');
		$routes->get('inventory/delete/(:num)', 'Inventory::delete/$1');

		$routes->get('location', 'Location::index');
		$routes->post('location/create', 'Location::create');
		$routes->post('location/update', 'Location::update');
		$routes->get('location/delete/(:num)', 'Location::delete/$1');

		$routes->get('suppliers', 'Suppliers::index');
		$routes->post('suppliers/create', 'Suppliers::create');
		$routes->post('suppliers/update', 'Suppliers::update');
		$routes->get('suppliers/delete/(:num)', 'Suppliers::delete/$1');

		$routes->get('customers', 'Customers::index');
		$routes->post('customers', 'Customers::createCust');
		$routes->post('customers/update', 'Customers::update');
		$routes->get('customers/delete/(:num)', 'Customers::delete/$1');

		$routes->get('categories', 'Categories::index');
		$routes->post('categories/create', 'Categories::create');
		$routes->post('categories/update', 'Categories::update');
		$routes->get('categories/delete/(:num)', 'Categories::delete/$1');

		$routes->get('transaction', 'Transaction::index');
		$routes->post('transaction/create', 'Transaction::create');
		$routes->post('transaction/update', 'Transaction::update');
		$routes->get('transaction/delete/(:num)', 'Transaction::delete/$1');

		$routes->get('history', 'History::index');
		$routes->post('history/create', 'History::create');
		$routes->post('history/update', 'History::update');
		$routes->get('history/delete/(:num)', 'History::delete/$1');
	});
	// END Manajemen Inventory

	$routes->group('im-manajemen-server', ['namespace' => 'App\Controllers\Imasnet\ManajemenServer'], function ($routes) {

		$routes->get('server', 'Server::index');
		$routes->post('server/create', 'Server::create');
		$routes->post('server/update', 'Server::update');
		$routes->get('server/delete/(:num)', 'Server::delete/$1');

		$routes->get('users-pengelola', 'UsersPengelola::index');
		$routes->post('users-pengelola/create', 'UsersPengelola::create');
		$routes->post('users-pengelola/update', 'UsersPengelola::update');
		$routes->get('users-pengelola/delete/(:num)', 'UsersPengelola::delete/$1');
	});

	$routes->group('im-manajemen-customer', ['namespace' => 'App\Controllers\Imasnet\ManajemenCustomer'], function ($routes) {

		$routes->get('customer', 'Customer::index');
		$routes->post('customer/create', 'Customer::create');
		$routes->post('customer/update', 'Customer::update');
		$routes->get('customer/delete/(:num)', 'Customer::delete/$1');
	});

	$routes->group('im-manajemen-assets', ['namespace' => 'App\Controllers\Imasnet\ManajemenAssets'], function ($routes) {

		$routes->get('data-aset', 'DataAssets::index');
		$routes->post('data-aset/create', 'DataAssets::create');
		$routes->post('data-aset/update', 'DataAssets::update');
		$routes->get('data-aset/delete/(:num)', 'DataAssets::delete/$1');

		$routes->get('kategori-aset', 'KategoriAssets::index');
		$routes->post('kategori-aset/create', 'KategoriAssets::create');
		$routes->post('kategori-aset/update', 'KategoriAssets::update');
		$routes->get('kategori-aset/delete/(:num)', 'KategoriAssets::delete/$1');
	});

	$routes->group('im-manajemen-keuangan', ['namespace' => 'App\Controllers\Imasnet\ManajemenKeuangan'], function ($routes) {

		$routes->get('data-keuangan', 'DataKeuangan::index');
		$routes->post('data-keuangan/create', 'DataKeuangan::create');
		$routes->post('data-keuangan/update', 'DataKeuangan::update');
		$routes->get('data-keuangan/delete/(:num)', 'DataKeuangan::delete/$1');

		$routes->get('kategori-keuangan', 'KategoriKeuangan::index');
		$routes->post('kategori-keuangan/create', 'KategoriKeuangan::create');
		$routes->post('kategori-keuangan/update', 'KategoriKeuangan::update');
		$routes->get('kategori-keuangan/delete/(:num)', 'KategoriKeuangan::delete/$1');

		$routes->get('jenis-keuangan', 'JenisKeuangan::index');
		$routes->post('jenis-keuangan/create', 'JenisKeuangan::create');
		$routes->post('jenis-keuangan/update', 'JenisKeuangan::update');
		$routes->get('jenis-keuangan/delete/(:num)', 'JenisKeuangan::delete/$1');

		$routes->get('pengelola-keuangan', 'PengelolaKeuangan::index');
		$routes->post('pengelola-keuangan/create', 'PengelolaKeuangan::create');
		$routes->post('pengelola-keuangan/update', 'PengelolaKeuangan::update');
		$routes->get('pengelola-keuangan/delete/(:num)', 'PengelolaKeuangan::delete/$1');

		$routes->get('riwayat-transaksi', 'RiwayatKeuangan::index');
		$routes->get('riwayat-transaksi/delete', 'RiwayatKeuangan::deleteAll');

		$routes->get('laporan-keuangan', 'LaporanKeuangan::index');
		$routes->post('laporan-keuangan/create', 'LaporanKeuangan::create');
		$routes->post('laporan-keuangan/update', 'LaporanKeuangan::update');
		$routes->get('laporan-keuangan/delete/(:num)', 'LaporanKeuangan::delete/$1');
	});

	$routes->group('im-manajemen-voucher', ['namespace' => 'App\Controllers\Imasnet\ManajemenVoucher'], function ($routes) {

		$routes->get('voucher', 'Voucher::index');
		$routes->post('voucher/create', 'Voucher::create');
		$routes->post('voucher/delete/checkbox', 'Voucher::deleteCheckbox');
		$routes->get('voucher/cetak', 'Voucher::cetak');
		$routes->get('voucher/myqr', 'Voucher::scanqrcode');
		$routes->get('voucher/(:segment)', 'Voucher::submitTransaksi/$1');


		$routes->get('paket', 'Paket::index');
		$routes->post('paket/create', 'Paket::create');
		$routes->post('paket/update', 'Paket::update');
		$routes->get('paket/delete/(:num)', 'Paket::delete/$1');

		$routes->get('reseller', 'Reseller::index');
		$routes->post('reseller/create', 'Reseller::create');
		$routes->post('reseller/update', 'Reseller::update');
		$routes->get('reseller/delete/(:num)', 'Reseller::delete/$1');

		$routes->get('pengirim', 'Pengirim::index');
		$routes->post('pengirim/create', 'Pengirim::create');
		$routes->post('pengirim/update', 'Pengirim::update');
		$routes->get('pengirim/delete/(:num)', 'Pengirim::delete/$1');

		$routes->get('riwayat', 'Riwayat::index');
		$routes->post('riwayat/submitPengiriman', 'Riwayat::pengirimanPost');
	});
});
// END SCC IMASNET

// Routes For Kredit_App
$routes->group('', ['namespace' => 'App\Controllers\Kredit_App'], function ($routes) {

	// ka-dashboard
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
