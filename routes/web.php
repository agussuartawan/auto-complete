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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', 'AutocompleteController@index');
Route::post('/store', 'AutocompleteController@store');
Route::get('/cari_customer', 'AutocompleteController@cari_customer')->name('cari_customer');
Route::post('/customer/store', 'AutocompleteController@customer_store')->name('customer.store');
Route::get('/customer/create', 'AutocompleteController@create');
Route::post('customer/add', 'AutocompleteController@customerStore');
Route::get('/cari_produk', 'AutocompleteController@cari_produk')->name('cari_produk');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
