<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class)->except('index','create','store');
Route::delete('/products/{product}/sales/{sale}', [ProductController::class, 'removeSale'])->name('products.removeSale');
Route::resource('products', ProductController::class); 
Route::resource('sales', SaleController::class);
Route::post('products/{id}/rate', [ProductController::class, 'rate'])->name('products.rate');
