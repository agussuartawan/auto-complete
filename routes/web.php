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

Route::get('/', 'AutocompleteController@index');

Route::post('/store', 'AutocompleteController@store');
Route::get('/cari_customer', 'AutocompleteController@cari_customer')->name('cari_customer');
Route::post('/customer/store', 'AutocompleteController@customer_store')->name('customer.store');
Route::get('/customer/create', 'AutocompleteController@create');
Route::post('customer/add', 'AutocompleteController@customerStore');
Route::get('/cari_produk', 'AutocompleteController@cari_produk')->name('cari_produk');
Route::post('transaksi/store', 'AutocompleteController@transaksi_store')->name('transaksi.store');
Route::get('/transaksi/show/{id}', 'AutocompleteComtroller@show')->name('transaksi.show');
Route::get('/transaksi/edit/{id}', 'AutocompleteComtroller@show')->name('transaksi.edit');
Route::put('/transaksi/delete/{id}', 'AutocompleteComtroller@show')->name('transaksi.delete');
Route::get('/transaksi/table', 'AutocompleteController@dataTable')->name('transaksi.table');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
