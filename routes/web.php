<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// products　　　index.blade.phpと繋げる　　商品一覧画面を表示するためのルート
Route::get('/products', [ProductController::class, 'index'])->middleware('auth');

// products create.blade.phpと繋げる　品登録画面を表示するルート
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth');

// products create.blade.php 商品登録データを受け取る
Route::post('/products', [ProductController::class, 'store'])->middleware('auth');


Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);

// ログイン
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'authenticate']);

// ログアウト
Route::post('/logout', [UserController::class, 'logout']);
