<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginView'])->name('view.login');
Route::get('/signup', [AuthController::class, 'registerView'])->name('view.register');
Route::get("/dashboard", [AuthController::class, 'dashboardView'])->name('view.dashboard');


Route::get('/api', [AuthController::class, 'getToken']);

Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::get('/api/products/{id}', [ProductController::class, 'getProductById']);

// Route::middleware([AuthMiddleware::class, AdminCheckMiddleware::class])->group(function () {
    Route::post('/api/products/', [ProductController::class, 'storeProduct']);
    Route::put('/api/products/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/api/products/{id}', [ProductController::class, 'destroyProduct']);
// });

Route::post('/api/login', [AuthController::class, 'login'])->name('login');
Route::post('/api/register', [AuthController::class, 'register'])->name('register');

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/api/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);
    Route::get('/api/carts', [CartController::class, 'getCarts']);
    Route::post('/api/products/{id}/carts', [CartController::class, 'addProductToCart']);
    Route::delete('/api/products/{id}/carts', [CartController::class, 'removeProductFromCart']);
});

