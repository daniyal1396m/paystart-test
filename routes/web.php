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
    $products = \App\Models\Product::all();
    return view('index',compact('products'));
});
Route::get('/cart/store/{id}',[\App\Http\Controllers\HomeController::class,'addToCart'])->name('cart.store');

Auth::routes();
Route::post('pay/store',[\App\Http\Controllers\PayController::class,'pay_store'])->name('api.pay.store');
Route::get('pay/store/response/{id}/{response}/{curl}',[\App\Http\Controllers\PayController::class,'pay_store_response'])->name('api.pay.store.response');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
