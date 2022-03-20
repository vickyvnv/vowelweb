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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home',  [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);
Route::resource('/home/products', App\Http\Controllers\ProductCrudController::class);
Route::get('/home', [App\Http\Controllers\ProductController::class, 'index']);  
Route::get('/home/cart', [App\Http\Controllers\ProductController::class, 'cart'])->name('cart');
Route::get('/home/add-to-cart/{id}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('/home/update-cart', [App\Http\Controllers\ProductController::class, 'update'])->name('update.cart');
Route::delete('/home/remove-from-cart', [App\Http\Controllers\ProductController::class, 'remove'])->name('remove.from.cart');

Route::get('payment', [App\Http\Controllers\PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [App\Http\Controllers\PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [App\Http\Controllers\PayPalController::class, 'success'])->name('payment.success');