@extends('layouts.app')

@section('content')

<div class="my-product-edit-container">

  <h1>出品商品編集</h1>

  @if ($errors->any())
  <ul class="edit-errors">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <form
    action="/my-products/{{ $product->id }}"
    method="POST"
    enctype="multipart/form-data"
    class="my-product-edit-form">
    @csrf
    @method('PUT')

    <div class="edit-form-group">
      <label for="product_name">商品名</label>
      <input
        type="text"
        id="product_name"
        name="product_name"
        value="{{ old('product_name', $product->product_name) }}">
    </div>

    <div class="edit-form-group">
      <label for="price">価格</label>
      <input
        type="number"
        id="price"
        name="price"
        value="{{ old('price', $product->price) }}">
    </div>

    <div class="edit-form-group">
      <label for="description">商品説明</label>
      <textarea
        id="description"
        name="description"
        rows="5">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="edit-form-group">
      <label for="stock">在庫数</label>
      <input
        type="number"
        id="stock"
        name="stock"
        value="{{ old('stock', $product->stock) }}">
    </div>

    <div class="edit-image-group">
      <label>商品画像</label>

      @if ($product->img_path)
      <img
        src="{{ asset('storage/' . $product->img_path) }}"
        alt="{{ $product->product_name }}"
        class="edit-current-image">
      @endif

      <div class="edit-file-input">
        <input type="file" name="img_path" id="img_path">
        @error('img_path')
        <p class="edit-error-message">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <div class="edit-form-actions">
      <a
        href="/my-products/{{ $product->id }}"
        class="back-button">
        戻る
      </a>

      <button type="submit" class="cart-button">
        更新
      </button>
    </div>

  </form>

</div>

@endsection
