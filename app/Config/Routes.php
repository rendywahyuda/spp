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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/panduan', 'Pages::user_guide', ['filter' => 'siswanoauth']);


// Admin
$routes->get('/', 'Auth::index', ['filter' => 'adminnoauth']);
$routes->get('/admin/logout', 'Auth::admin_logout');
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'adminauth']);
$routes->get('/admin/bendahara', 'Bendahara::index', ['filter' => 'adminauth']);
$routes->get('/admin/bendahara/tambah', 'Bendahara::create', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/bendahara/edit', 'Bendahara::edit/$1', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/bendahara/delete', 'Bendahara::delete/$1', ['filter' => 'adminauth']);
$routes->get('/admin/kelas', 'Kelas::index', ['filter' => 'adminauth']);
$routes->get('/admin/kelas/tambah', 'Kelas::create', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/kelas/edit', 'Kelas::edit/$1', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/kelas/delete', 'Kelas::delete/$1', ['filter' => 'adminauth']);
$routes->get('/admin/siswa', 'Siswa::index', ['filter' => 'adminauth']);
$routes->get('/admin/siswa/tambah', 'Siswa::create', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/siswa/edit', 'Siswa::edit/$1', ['filter' => 'adminauth']);
$routes->get('/admin/tahun_pelajaran', 'TahunPelajaran::index', ['filter' => 'adminauth']);
$routes->get('/admin/tahun_pelajaran/tambah', 'TahunPelajaran::create', ['filter' => 'adminauth']);
$routes->get('/admin/(:num)/tahun_pelajaran/edit', 'TahunPelajaran::edit/$1', ['filter' => 'adminauth']);
$routes->get('/admin/log_siswa', 'Pages::log_siswa', ['filter' => 'adminauth']);
$routes->get('/admin/log_bendahara', 'Pages::log_bendahara', ['filter' => 'adminauth']);
$routes->get('/admin/log_kelas', 'Pages::log_kelas', ['filter' => 'adminauth']);
$routes->get('/admin/log_tahun_pelajaran', 'Pages::log_tahun_pelajaran', ['filter' => 'adminauth']);
$routes->get('/admin/tambah_kelas', 'Kelas::insertKelas', ['filter' => 'adminauth']);
$routes->get('/admin/tampil_kelas', 'Kelas::showKelas', ['filter' => 'adminauth']);
$routes->get('/admin/tampil_siswa', 'Siswa::showSiswa', ['filter' => 'adminauth']);
$routes->get('/admin/tampil_bendahara', 'Bendahara::showBendahara', ['filter' => 'adminauth']);
$routes->get('/admin/tampil_tahun_pelajaran', 'TahunPelajaran::showTapel', ['filter' => 'adminauth']);
$routes->get('/admin/tunggakan_siswa', 'Siswa::tunggakan_siswa', ['filter' => 'adminauth']);


// Siswa
$routes->get('/', 'Auth::index', ['filter' => 'siswanoauth']);
$routes->get('/siswa/logout', 'Auth::siswa_logout');
$routes->match(['get', 'post'], '/siswa/transaksi', 'Transaksi::transaksi', ['filter' => 'siswaauth']);
$routes->match(['get', 'post'], '/siswa/profile', 'Auth::siswa_profile', ['filter' => 'siswaauth']);
$routes->get('/siswa/dashboard', 'Siswa::dashboard', ['filter' => 'siswaauth']);
$routes->get('/siswa/detail_spp', 'Siswa::detail_spp', ['filter' => 'siswaauth']);
$routes->get('/siswa/riwayat', 'Transaksi::history', ['filter' => 'siswaauth']);
$routes->get('/siswa/riwayat/(:num)/detail', 'Transaksi::siswa_history_detail/$1', ['filter' => 'siswaauth']);
$routes->get('/siswa/riwayat/pending', 'Transaksi::siswa_riwayat_pending', ['filter' => 'siswaauth']);



// Bendahara
$routes->get('/', 'Auth::index', ['filter' => 'bendaharanoauth']);
$routes->get('/bendahara/logout', 'Auth::bendahara_logout');
$routes->match(['get', 'post'], '/bendahara/profile', 'Auth::bendahara_profile', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/dashboard', 'Bendahara::dashboard', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/rekap', 'Laporan::kelas_siswa', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/(:num)/rekap/siswa', 'Laporan::list_siswa/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/(:num)/laporan/rekap_siswa', 'Laporan::rekap_siswa/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/laporan/rekap_keuangan', 'Laporan::rekap_keuangan', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/transaksi', 'Transaksi::transaksi_new', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/transaksi/new/(:num)/detail', 'Transaksi::transaksi_new_detail/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/riwayat', 'Transaksi::petugas_history', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/riwayat/(:num)/detail', 'Transaksi::petugas_history_detail/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/biayaspp', 'BiayaSpp::index', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/biayaspp/tambah', 'BiayaSpp::create', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/(:num)/biayaspp/edit', 'BiayaSpp::edit/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/(:num)/biayaspp/delete', 'BiayaSpp::delete/$1', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/spp', 'Spp::index', ['filter' => 'bendaharaauth']);
$routes->get('/bendahara/spp/tambah', 'Spp::create', ['filter' => 'bendaharaauth']);


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
