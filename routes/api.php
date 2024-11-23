<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

});
//Route::resource('products', ProductController::class);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'store']);
Route::post('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);
Route::get('carts', [CartController::class, 'index'])->middleware('auth:sanctum');
Route::post('carts/{product_id}', [CartController::class, 'store'])->middleware('auth:sanctum');


