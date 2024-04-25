<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('product', 'ProductController');

Route::get('/index','ProductController@index')->name('list');
Route::get('/search','ProductController@search')->name('products.search');

Route::get('/product_info_detail/{id}', [App\Http\Controllers\ProductController::class, 'getId'])->name('product_info_detail');

Route::get('/product_regist', 'ProductController@add')->name('add');
Route::post('/product_regist', 'ProductController@store')->name('store');

Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
Route::put('/products/{id}', 'ProductController@update')->name('products.update');
Route::get('/products/{id}/details', 'ProductController@show')->name('products.details');


Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');
