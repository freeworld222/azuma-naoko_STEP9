<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;

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

// 商品詳細画面を表示
Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('auth');

// お気に入りの登録・解除
Route::post('/products/{productId}/like', [LikeController::class, 'toggle'])
    ->middleware('auth');
