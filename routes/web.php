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


Auth::routes();
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create')->middleware('auth');
Route::post('/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::delete('/products/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
Route::get('/products/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::put('/products/{product}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/search', [\App\Http\Controllers\ProductController::class,'search'])->name('products.search');
Route::get('/profile', [\App\Http\Controllers\ProfileController::class,'show'])->name('profile.show')->middleware('auth');
Route::put('/profile/update', [\App\Http\Controllers\ProfileController::class,'update'])->name('profile.update')->middleware('auth');

Route::get('/admin', [\App\Http\Controllers\ProductController::class,'admin'])->name('admin')->middleware('auth');
Route::put('/products/{product}/toggle',[\App\Http\Controllers\ProductController::class,'toggle'])->name('products.toggle')->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


