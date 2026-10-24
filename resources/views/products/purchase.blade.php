@extends('layouts.app')

@section('content')

<h1>購入確認画面</h1>

<h2>商品情報</h2>

<p>商品名：{{ $product->product_name }}</p>
<p>商品説明：{{ $product->description }}</p>
<p>画像：{{ $product->img_path }}</p>
<p>金額：￥{{ $product->price }}</p>
<p>会社：{{ $product->company->company_name ?? '会社情報なし' }}</p>


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
