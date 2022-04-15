<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index');
    Route::get('products/{product}', 'show');
    Route::post('products', 'store');
    Route::put('products/{product}', 'update');
    Route::delete('products/{product}', 'delete');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('categories/{category}', 'show');
    Route::post('categories', 'store');
    Route::put('categories/{category}', 'update');
    Route::delete('categories/{category}', 'delete');
});
