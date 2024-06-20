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

// 一覧
Route::get('/index','ProductController@index')->name('products.list');
Route::get('/products/sort', 'ProductController@sort')->name('products.sort');

// 検索
Route::get('/products/search', 'ProductController@search')->name('products.search');

// 詳細
Route::get('/detail/{id}', 'ProductController@getId')->name('products.detail');

// 新規登録
Route::get('/product_regist', 'ProductController@add')->name('products.add');
Route::post('/product_regist', 'ProductController@store')->name('products.store');

// 編集
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');

// 更新
Route::put('/products/{id}', 'ProductController@update')->name('products.update');
Route::get('/products/{id}/details', 'ProductController@show')->name('products.details');

// 削除
Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');
