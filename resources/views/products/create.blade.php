@extends('layouts.app')

@section('content')

<div class="product-create-container">

  <h1>商品登録</h1>

  @if ($errors->any())
  <ul class="error-messages">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <form action="/products" method="POST" enctype="multipart/form-data" class="product-create-form">
    @csrf

    <div class="product-create-group">
      <label for="product_name">商品名</label>
      <input
        type="text"
        id="product_name"
        name="product_name"
        value="{{ old('product_name') }}">
    </div>

    <div class="product-create-group">
      <label for="price">価格</label>
      <input
        type="number"
        id="price"
        name="price"
        value="{{ old('price') }}">
    </div>

    <div class="product-create-group">
      <label for="description">商品説明</label>
      <textarea
        id="description"
        name="description">{{ old('description') }}</textarea>
    </div>

    <div class="product-create-group">
      <label for="stock">在庫数</label>
      <input
        type="number"
        id="stock"
        name="stock"
        value="{{ old('stock') }}">
    </div>

    <div class="product-create-group">
      <label for="img_path">商品画像</label>
      <input
        type="file"
        id="img_path"
        name="img_path">
    </div>

    <div class="product-create-actions">
      <a href="/products" class="back-button">戻る</a>
      <button type="submit" class="cart-button">登録</button>
    </div>

  </form>

</div>

@endsection
