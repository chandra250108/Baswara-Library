<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route untuk admin
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/buku'] = 'admin/buku';
$route['admin/anggota'] = 'admin/anggota';
$route['admin/transaksi'] = 'admin/transaksi';
$route['admin/laporan'] = 'admin/laporan';
$route['admin/cari_buku_terhapus'] = 'admin/cari_buku_terhapus';
$route['admin/anggota_terhapus'] = 'admin/anggota_terhapus';
$route['admin/restore_anggota/(:any)'] = 'admin/restore_anggota/$1';
$route['admin/cari_anggota_terhapus'] = 'admin/cari_anggota_terhapus';

// Route untuk siswa
$route['siswa/dashboard'] = 'siswa/dashboard';
$route['siswa/peminjaman'] = 'siswa/peminjaman';
$route['siswa/riwayat'] = 'siswa/riwayat';
$route['siswa/buku'] = 'siswa/buku';

// Route untuk auth
$route['login'] = 'auth/login';
$route['register'] = 'auth/register_siswa';
$route['logout'] = 'auth/logout';

// Route untuk transaksi
$route['admin/edit_transaksi/(:any)'] = 'admin/edit_transaksi/$1';
$route['admin/update_transaksi/(:any)'] = 'admin/update_transaksi/$1';
$route['admin/hapus_transaksi/(:any)'] = 'admin/hapus_transaksi/$1';
$route['admin/update_transaksi_lengkap/(:any)'] = 'admin/update_transaksi_lengkap/$1';
$route['admin/update_transaksi_laporan'] = 'admin/update_transaksi_laporan';

// Route untuk laporan
$route['admin/export_excel'] = 'admin/export_excel';
$route['admin/cetak_laporan'] = 'admin/cetak_laporan';
$route['admin/edit_transaksi_laporan/(:any)'] = 'admin/edit_transaksi_laporan/$1';
$route['admin/update_transaksi_laporan/(:any)'] = 'admin/update_transaksi_laporan/$1';
$route['admin/hapus_transaksi_laporan/(:any)'] = 'admin/hapus_transaksi_laporan/$1';