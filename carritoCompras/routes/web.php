<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
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
Route::get('/register',[RegisterController::class,'show']);
Route::POST('/register',[RegisterController::class,'register']);
Route::get('/login',[LoginController::class,'show']);
Route::POST('/login',[LoginController::class,'login']);
Route::get('/logout',[LogoutController::class,'logout']);

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/', [CartController::class, 'index'])->name('index');
Route::get('/inicio', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/history', [CartController::class, 'history'])->name('history');
Route::resource('/products', ProductsController::class)->middleware('auth.admin');
