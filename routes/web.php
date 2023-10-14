<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('product');
});

Route::get('/products/create', function () {
    return view('create');
});

Auth::routes();

Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store')->middleware('auth');

Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


