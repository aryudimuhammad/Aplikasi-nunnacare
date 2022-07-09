<?php
use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::get('/detail/{id}', [App\Http\Controllers\produkController::class, 'detail'])->name('detail');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/', [App\Http\Controllers\produkController::class, 'welcome'])->name('welcome');
Route::post('/', [App\Http\Controllers\produkController::class, 'welcome'])->name('welcome');


Route::get('/admin/dashboard', [App\Http\Controllers\produkController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/produk', [App\Http\Controllers\produkController::class, 'produk'])->name('produk');
Route::get('/admin/user', [App\Http\Controllers\userController::class, 'user'])->name('user');
Route::get('/admin/supplier', [App\Http\Controllers\supplierController::class, 'supplier'])->name('supplier');
Route::get('/detail/supplier/{id}', [App\Http\Controllers\supplierController::class, 'detailsupplier'])->name('detailsupplier');
