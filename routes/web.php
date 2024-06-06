<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/api', [AuthController::class, 'getToken']);

Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::post('/api/products/', [ProductController::class, 'storeProduct']);
Route::put('/api/products/{id}', [ProductController::class, 'updateProduct']);
Route::get('/api/products/{id}', [ProductController::class, 'getProductById']);
Route::delete('/api/products/{id}', [ProductController::class, 'destroyProduct']);


Route::get('/api/login', [AuthController::class, 'login']);
