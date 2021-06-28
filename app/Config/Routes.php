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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index', ['filter' => 'noauth']);
$routes->match(['get', 'post'], '/login', 'Login::masuk', ['filter' => 'noauth']);
$routes->get('/logout', 'Login::keluar', ['filter' => 'auth']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('/settings', 'Web::index', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->get('/settings/edit', 'Web::ubah', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->post('/settings/update/(:segment)', 'Web::ubah_data/$1', ['filter' => 'auth', 'filter' => 'authadmin']);

$routes->get('/admin', 'Users::index', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->get('/admin/add', 'Users::tambah', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->post('/admin/save', 'Users::simpan', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->get('/admin/edit/(:segment)', 'Users::ubah/$1', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->post('/admin/update/(:segment)', 'Users::ubah_data/$1', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->get('/admin/(:segment)', 'Users::detail/$1', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->post('/admin/searching', 'Users::pencarian', ['filter' => 'auth', 'filter' => 'authadmin']);
$routes->get('/admin/search/(:segment)', 'Users::cari/$1', ['filter' => 'auth', 'filter' => 'authadmin']);

$routes->get('/profile', 'Users::profil', ['filter' => 'auth']);
$routes->get('/password', 'Users::pass', ['filter' => 'auth']);
$routes->post('/newpassword', 'Users::ubah_password', ['filter' => 'auth']);

$routes->get('/items', 'Barang::data_barang');
$routes->get('/item', 'Barang::index', ['filter' => 'auth']);
$routes->get('/item/add', 'Barang::tambah', ['filter' => 'auth']);
$routes->post('/item/save', 'Barang::simpan', ['filter' => 'auth']);
$routes->get('/item/edit/(:segment)', 'Barang::ubah/$1', ['filter' => 'auth']);
$routes->post('/item/update/(:segment)', 'Barang::ubah_data/$1', ['filter' => 'auth']);
$routes->get('/item/(:segment)', 'Barang::detail/$1', ['filter' => 'auth']);
$routes->post('/item/searching', 'Barang::pencarian', ['filter' => 'auth']);
$routes->get('/item/search/(:segment)', 'Barang::cari/$1', ['filter' => 'auth']);

$routes->get('/supply', 'Suplai::index', ['filter' => 'auth']);
$routes->get('/supply/new', 'Suplai::tambah', ['filter' => 'auth']);
$routes->post('/supply/add', 'Suplai::tambah_barang', ['filter' => 'auth']);
$routes->post('/supply/edit', 'Suplai::edit_barang', ['filter' => 'auth']);
$routes->get('/supply/delete/(:any)', 'Suplai::hapus_barang/$1', ['filter' => 'auth']);
$routes->get('/supply/clear', 'Suplai::clear', ['filter' => 'auth']);
$routes->post('/supply/save', 'Suplai::simpan', ['filter' => 'auth']);
$routes->get('/supply/(:segment)', 'Suplai::detail/$1', ['filter' => 'auth']);
$routes->post('/supply/searching', 'Suplai::pencarian', ['filter' => 'auth']);
$routes->get('/supply/search/(:segment)', 'Suplai::cari/$1', ['filter' => 'auth']);
$routes->get('/supply/print/(:segment)', 'Suplai::print/$1', ['filter' => 'auth']);

$routes->get('/export', 'Keluar::index', ['filter' => 'auth']);
$routes->get('/export/new', 'Keluar::tambah', ['filter' => 'auth']);
$routes->post('/export/add', 'Keluar::tambah_barang', ['filter' => 'auth']);
$routes->post('/export/edit', 'Keluar::edit_barang', ['filter' => 'auth']);
$routes->get('/export/delete/(:any)', 'Keluar::hapus_barang/$1', ['filter' => 'auth']);
$routes->get('/export/clear', 'Keluar::clear', ['filter' => 'auth']);
$routes->post('/export/save', 'Keluar::simpan', ['filter' => 'auth']);
$routes->get('/export/(:segment)', 'Keluar::detail/$1', ['filter' => 'auth']);
$routes->post('/export/searching', 'Keluar::pencarian', ['filter' => 'auth']);
$routes->get('/export/search/(:segment)', 'Keluar::cari/$1', ['filter' => 'auth']);
$routes->get('/export/print/(:segment)', 'Keluar::print/$1', ['filter' => 'auth']);

$routes->get('/history', 'History::index', ['filter' => 'auth']);
$routes->post('/history/searching', 'History::pencarian', ['filter' => 'auth']);
$routes->get('/history/search/(:segment)', 'History::cari/$1', ['filter' => 'auth']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
