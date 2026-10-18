<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index'])->middleware('auth');

Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);

// ログイン
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'authenticate']);

// ログアウト
Route::post('/logout', [UserController::class, 'logout']);
