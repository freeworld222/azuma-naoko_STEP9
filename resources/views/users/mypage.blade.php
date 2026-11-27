@extends('layouts.app')

@section('content')

<div class="mypage-container">

  <h1>マイページ</h1>

  <div class="mypage-profile">
    <button type="button" class="account-edit-button"
      onclick="location.href='/mypage/edit'">
      アカウント編集
    </button>

    <div class="user-info">
      <div>
        <p>ユーザ名：{{ $user->name }}</p>
        <p>Eメール：{{ $user->email }}</p>
      </div>

      <div>
        <p>名前：{{ $user->name_kanji }}</p>
        <p>カナ：{{ $user->name_kana }}</p>
      </div>
    </div>
  </div>

  <div class="mypage-section">
    <div class="mypage-section-header">
      <h2>出品商品</h2>
      <a href="/products/create" class="new-product-button">新規登録</a>
    </div>

    <table class="mypage-table mypage-products-table">
      <tr>
        <th>商品番号</th>
        <th>商品名</th>
        <th>商品説明</th>
        <th>料金（￥）</th>
        <th>詳細</th>
      </tr>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td><a href="/my-products/{{ $product->id }}">詳細</a></td>
      </tr>
      @endforeach
    </table>
  </div>


  <div class="mypage-section">
    <h2>購入した商品</h2>

    <table class="mypage-table mypage-products-table">
      <tr>
        <th>商品名</th>
        <th>商品説明</th>
        <th>料金（￥）</th>
        <th>個数</th>
      </tr>
      @foreach ($sales as $sale)
      <tr>
        <td>{{ $sale->product->product_name }}</td>
        <td>{{ $sale->product->description }}</td>
        <td>{{ $sale->product->price }}</td>
        <td>{{ $sale->quantity }}</td>
      </tr>
      @endforeach
    </table>
  </div>

  @endsection
