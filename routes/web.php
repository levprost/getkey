<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class);
Route::delete('/products/{product}/sales/{sale}', [ProductController::class, 'removeSale'])->name('products.removeSale');
Route::resource('products', ProductController::class); 
Route::resource('sales', SaleController::class);
