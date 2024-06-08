<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/api', [AuthController::class, 'getToken']);

Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::get('/api/products/{id}', [ProductController::class, 'getProductById']);

Route::middleware([AuthMiddleware::class, AdminCheckMiddleware::class])->group(function () {
    Route::post('/api/products/', [ProductController::class, 'storeProduct']);
    Route::put('/api/products/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/api/products/{id}', [ProductController::class, 'destroyProduct']);
});

Route::get('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);
Route::get('/api/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);

