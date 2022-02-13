<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Login_controller@index');
Route::get('/login','Login_controller@index');
Route::get('/login/proseslogin','Login_controller@login');
Route::get('/logout','Home_controller@logout');

Route::get('/home','Home_controller@index');
Route::get('/home/add','Home_controller@add_pinjam');
Route::get('/home/addadmin','Home_controller@add_pinjam_admin');

//Revisi
Route::get('/home/return','Home_controller@add_pengembalian');
Route::get('/home/confirmReturn','Home_controller@confirm_pengembalian');
// \Revisi

Route::get('/riwayat','Riwayat_order_controller@index');

Route::get('/inventaris','Inventaris_controller@index');

Route::get('/pembelian','Pembelian_controller@index');
Route::get('/pembelian/tambah','Pembelian_controller@tambah_pembelian');

Route::get('/laporan','Laporan_controller@index');
Route::get('/laporan/peminjaman','Laporan_controller@l_peminjaman');
Route::get('/laporan/pembelian','Laporan_controller@l_pembelian');

Route::get('/peminjam','PeminjamController@index');
Route::get('/peminjam/{id}','PeminjamController@detail');
Route::post('/peminjam/add', 'PeminjamController@add');
Route::post('/peminjam/edit', 'PeminjamController@edit');
Route::get('/peminjam/delete/{id}', 'PeminjamController@delete');