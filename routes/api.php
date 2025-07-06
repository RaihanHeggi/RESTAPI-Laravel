<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'index'])->name('api');
Route::get('/signin', [AuthController::class, 'index'])->name('signin');
Route::get('/register', [AuthController::class, 'index'])->name('signup');

Route::middleware('auth:sanctum')->group( function () {
    // Route::resource('products', ProductController::class);
});