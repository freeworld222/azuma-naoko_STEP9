@extends('layouts.app')

@section('content')

<h1>購入確認画面</h1>

<h2>商品情報</h2>

<p>商品名：{{ $product->product_name }}</p>
<p>商品説明：{{ $product->description }}</p>
<p>画像：{{ $product->img_path }}</p>
<p>金額：￥{{ $product->price }}</p>
<p>会社：{{ $product->company->company_name ?? '会社情報なし' }}</p>

@if (session('success'))
<div id="purchase-modal"
  style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 9999;">

  <div style="background: white; padding: 30px; border-radius: 10px; text-align: center;">
    <p>{{ session('success') }}</p>
    <button type="button" onclick="document.getElementById('purchase-modal').remove()">
      閉じる
    </button>
  </div>

</div>
@endif

<form action="/products/{{ $product->id }}/purchase" method="POST">
  @csrf

  <div>
    <label for="quantity">購入個数</label>
    <input
      type="number"
      id="quantity"
      name="quantity"
      min="1"
      max="{{ $product->stock }}"
      value="{{ old('quantity', 1) }}"
      required>
  </div>

  <p>在庫数：{{ $product->stock }}</p>

  @error('quantity')
  <p>{{ $message }}</p>
  @enderror

  <button type="submit">購入する</button>
</form>

<a href="/products/{{ $product->id }}">戻る</a>

@endsection
