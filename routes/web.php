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
Route::get('/', [App\Http\Controllers\produkController::class, 'welcome'])->name('welcome');
Route::post('/', [App\Http\Controllers\produkController::class, 'welcome'])->name('welcome');
Route::get('/detail/{id}', [App\Http\Controllers\produkController::class, 'detail'])->name('detail');


Route::group(['middleware' => ['auth', 'Checkrole:1,2']], function ()
{
Route::post('/cart/{id}', [App\Http\Controllers\pesananController::class, 'cart'])->name('cart');
Route::get('/pembayaranlist/{id}', [App\Http\Controllers\pesananController::class, 'pembayaranlist'])->name('pembayaranlist');
Route::get('/pembayaran/{id}/{idn}', [App\Http\Controllers\pesananController::class, 'pembayaran'])->name('pembayaran');
Route::get('/pembayaran1/{id}', [App\Http\Controllers\pesananController::class, 'pembayaran1'])->name('pembayaran1');
Route::post('/pembayaran/{id}/{idn}', [App\Http\Controllers\pesananController::class, 'buktipembayaran'])->name('buktipembayaran');
Route::put('/pembayaran/{id}/{idn}', [App\Http\Controllers\pesananController::class, 'diterima'])->name('diterima');

});

Route::group(['middleware' => ['auth', 'Checkrole:1']], function ()
{
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/admin/dashboard', [App\Http\Controllers\produkController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/produk', [App\Http\Controllers\produkController::class, 'produk'])->name('produk');
Route::delete('/admin/produk/{id}', [App\Http\Controllers\produkController::class, 'deleteproduk'])->name('deleteproduk');
Route::get('/admin/detailproduk/{id}', [App\Http\Controllers\produkController::class, 'detailproduk'])->name('detailproduk');


Route::get('/admin/user', [App\Http\Controllers\userController::class, 'user'])->name('user');
Route::get('/admin/supplier', [App\Http\Controllers\supplierController::class, 'supplier'])->name('supplier');
Route::post('/admin/supplier', [App\Http\Controllers\supplierController::class, 'tambahsupplier'])->name('tambahsupplier');
Route::delete('/admin/supplier/{id}', [App\Http\Controllers\supplierController::class, 'deletesupplier'])->name('deletesupplier');
Route::get('/detail/supplier/{id}', [App\Http\Controllers\supplierController::class, 'detailsupplier'])->name('detailsupplier');
Route::put('/edit/detail/supplier/{id}', [App\Http\Controllers\supplierController::class, 'editsupplier'])->name('editsupplier');
Route::get('/admin/pesanan', [App\Http\Controllers\pesananController::class, 'adminpesanan'])->name('adminpesanan');
Route::post('/admin/pesanan/ongkir', [App\Http\Controllers\pesananController::class, 'ongkiradminpesanan'])->name('ongkiradminpesanan');
Route::post('/admin/pesanan', [App\Http\Controllers\pesananController::class, 'estimasiadminpesanan'])->name('estimasiadminpesanan');
});
