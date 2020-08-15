<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('anggota/exportexcel', 'AnggotaController@exportexcel')->name('anggota.exportexcel');
Route::resource('anggota', 'AnggotaController');

Route::post('buku/importexcel', 'BukuController@importexcel')->name('buku.importexcel');
Route::get('buku/exportexcel', 'BukuController@exportexcel')->name('buku.exportexcel');
Route::resource('buku', 'BukuController');

Route::post('peminjaman/importexcel', 'PeminjamanController@importexcel')->name('peminjaman.importexcel');
Route::get('peminjaman/exportexcel', 'PeminjamanController@exportexcel')->name('peminjaman.exportexcel');
Route::resource('peminjaman', 'PeminjamanController');

Route::resource('admin', 'AdminController');
