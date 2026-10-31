<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

// 商品一覧画面を表示
Route::get('/products', [ProductController::class, 'index'])->middleware('auth');

// 品登録画面を表示
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


// 出品商品詳細画面を表示
Route::get('/my-products/{id}', [ProductController::class, 'myShow'])->middleware('auth');

// 出品商品編集画面を表示
Route::get('/my-products/{id}/edit', [ProductController::class, 'editMyProduct'])->middleware('auth');

// 編集画面の「更新する」ボタンから送信されたデータを、ProductController の updateMyProduct() で受け取る
Route::put('/my-products/{id}', [ProductController::class, 'updateMyProduct'])->middleware('auth');


// 指定した出品商品を削除する処理
Route::delete('/my-products/{id}', [ProductController::class, 'destroyMyProduct'])->middleware('auth');



// お気に入りの登録・解除
Route::post('/products/{productId}/like', [LikeController::class, 'toggle'])
    ->middleware('auth');

// 購入確認画面を表示
Route::get('/products/{id}/purchase', [ProductController::class, 'purchase'])->middleware('auth');

// 購入処理
Route::post('/products/{id}/purchase', [ProductController::class, 'storePurchase'])->middleware('auth');

// お問い合わせ画面を表示
Route::get('/contact', function () {
    return view('contact');
})->middleware('auth');

// お問い合わせ内容を受け取る
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('auth');
