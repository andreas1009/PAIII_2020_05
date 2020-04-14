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

Route::get('/', 'HomeController@index');
Route::get('/login', 'AutentikasiController@login');
Route::prefix('admin')->group(function(){
	Route::get('/index','CbtController@index');
    Route::resource('/kategori', 'CategoryWisataController');
    Route::resource('CategoryAkomodasi', 'CategoryAkomodasiController');
    Route::resource('/ObjekWisata', 'ObjekWisataController');
    Route::resource('/Akomodasi', 'AkomodasiController');
    Route::resource('/Budaya', 'BudayaController');
    Route::resource('/Kuliner', 'KulinerController');
    Route::resource('/Event', 'EventController');
    Route::resource('/Transportasi', 'TransportasiController');
});
//login
Route::get('/login', 'AutentikasiController@login');

Route::prefix('autentikasi')->group(function(){
    Route::post('login_process', 'AutentikasiController@login_process');
    //logout
	Route::get('logout', 'AutentikasiController@logout_process');
});

//Kabupaten
Route::get('/Kab/{id}', 'KabupatenController@index');
