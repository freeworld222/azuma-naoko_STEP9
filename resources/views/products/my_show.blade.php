@extends('layouts.app')

@section('content')

<div class="my-product-detail-container">

  <h1>出品商品詳細</h1>

  <div class="my-product-detail-info">

    <p>商品名：{{ $product->product_name }}</p>

    <p>説明：{{ $product->description }}</p>

    <div class="my-product-image-area">
      <p>画像：</p>

      @if ($product->img_path)
      <img
        src="{{ asset('storage/' . $product->img_path) }}"
        alt="{{ $product->product_name }}"
        class="my-product-image">
      @endif
    </div>

    <p>金額：￥{{ $product->price }}</p>

    <div class="my-product-detail-actions">

      <a
        href="/my-products/{{ $product->id }}/edit"
        class="cart-button">
        編集
      </a>

      <form
        action="/my-products/{{ $product->id }}"
        method="POST"
        onsubmit="return confirm('この商品を削除してもよろしいですか？');">
        @csrf
        @method('DELETE')

        <button type="submit" class="delete-button">
          削除する
        </button>
      </form>

      <a href="/products" class="back-button">
        戻る
      </a>

    </div>

  </div>

</div>

@endsection
