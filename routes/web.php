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

Route::get('/', function() {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('products', 'ProductController')->names('products');



Route::get('change_status/ventas/{venta}', 'VentaController@change_status')->name('change.status.ventas');
Route::get('change_status/products/{product}', 'ProductController@change_status')->name('change.status.products');
