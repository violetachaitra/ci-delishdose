<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::registerProcess');

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
$routes->post('dashboard/update-status', 'Dashboard::updateStatus');
$routes->post('transaksi/updateStatus', 'TransaksiController::updateStatus');

$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);

// dashboard
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('dashboard/cetak', 'Dashboard::exportpdf', ['filter' => 'auth']);
$routes->get('dashboard/export-pdf', 'Dashboard::exportpdf', ['filter' => 'auth']);

//upload bukti
$routes->post('upload-bukti/(:num)', 'TransaksiController::uploadBukti/$1');
$routes->post('admin/update-status/(:num)', 'TransaksiController::updateStatus/$1');

//laporan penjualan
$routes->get('laporan-penjualan', 'LaporanController::index');
$routes->get('laporan-penjualan/download', 'LaporanController::download');
$routes->get('laporan-penjualan/export-excel', 'LaporanController::exportExcel');
$routes->get('laporan-penjualan/export-pdf', 'LaporanController::download');

$routes->resource('api', ['controller' => 'apiController']);

//update status
$routes->post('penjualan/updateStatus/(:any)', 'TransaksiController::updateStatus/$1', ['filter' => 'auth']); 
$routes->get('penjualan', 'Home::penjualan', ['filter' => 'auth']);