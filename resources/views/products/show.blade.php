@extends('layouts.app')

@section('content')

<div class="product-detail-container">

  <h1>商品詳細</h1>

  <div class="product-detail-info">

    <p>商品名：{{ $product->product_name }}</p>

    <p>説明：{{ $product->description }}</p>

    <div class="product-detail-image-area">
      <p>画像：</p>

      @if ($product->img_path)
      <img
        src="{{ asset('storage/' . $product->img_path) }}"
        alt="{{ $product->product_name }}"
        class="product-detail-image">
      @endif
    </div>

    <p>金額：￥{{ $product->price }}</p>

    <p>会社：{{ $product->company->company_name ?? '会社情報なし' }}</p>

    <form action="/products/{{ $product->id }}/like" method="POST">
      @csrf

      <button type="submit"
        class="favorite-button {{ $isLiked ? 'liked' : '' }}">
        ♥
      </button>
    </form>

    <div class="product-detail-actions">

      <form action="/products/{{ $product->id }}/purchase" method="GET">
        <button type="submit" class="cart-button">
          カートに追加する
        </button>
      </form>

      <a href="/products" class="back-button">戻る</a>

    </div>

  </div>

</div>

@endsection
