<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
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

Route::get('/product_info_list', [App\Http\Controllers\CompanyController::class, 'ProductInfoList'])->name('product_info_list');

Route::post('/product_info_list', [App\Http\Controllers\CompanyController::class, 'ProductInfoList'])->name('product_info_list');

Route::get('/product_info_detail/{id}', [App\Http\Controllers\CompanyController::class, 'ProductInfoDetail'])->name('product_info_detail');

Route::get('/product_register', [App\Http\Controllers\CompanyController::class, 'ProductRegister'])->name('product_register');

Route::post('/product_register',[App\Http\Controllers\CompanyController::class, 'RegistSubmit'])->name('regist_submit');


Route::get('/product_info_editor', [App\Http\Controllers\CompanyController::class, 'ProductInfoEditor'])->name('product_info_editor');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
