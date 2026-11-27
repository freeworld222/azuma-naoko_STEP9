@extends('layouts.app')

@section('content')

<div class="product-detail-container">

  <h1>購入画面</h1>

  @if ($errors->any())
  <ul class="error-messages">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <div class="product-detail-info">

    <p>商品名：{{ $product->product_name }}</p>
    <p>説明：{{ $product->description }}</p>

    <div class="product-detail-image-area">

      @if ($product->img_path)
      <img
        src="{{ asset('storage/' . $product->img_path) }}"
        alt="{{ $product->product_name }}"
        class="product-detail-image">
      @endif
    </div>

    <form action="/products/{{ $product->id }}/purchase" method="POST">
      @csrf

      <div class="purchase-quantity">
        <input
          type="number"
          id="quantity"
          name="quantity"
          min="1"
          max="{{ $product->stock }}"
          value="{{ old('quantity', 1) }}"
          required>
      </div>

      @error('quantity')
      <p class="error-message">{{ $message }}</p>
      @enderror

      <p>金額：￥{{ $product->price }}</p>
      <p>残り：{{ $product->stock }}</p>
      <p>会社：{{ $product->company->company_name ?? '会社情報なし' }}</p>

      <div class="product-detail-actions">
        <button type="submit" class="cart-button">
          購入する
        </button>

        <a href="/products/{{ $product->id }}" class="back-button">
          戻る
        </a>
      </div>

    </form>

  </div>
</div>

@endsection
