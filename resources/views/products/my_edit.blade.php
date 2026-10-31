@extends('layouts.app')

@section('content')

<h1>出品商品編集</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form action="/my-products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div>
    <label>商品名</label>
    <input type="text" name="product_name"
      value="{{ old('product_name', $product->product_name) }}">
  </div>

  <div>
    <label>価格</label>
    <input type="number" name="price"
      value="{{ old('price', $product->price) }}">
  </div>

  <div>
    <label>商品説明</label>
    <textarea name="description">{{ old('description', $product->description) }}</textarea>
  </div>

  <div>
    <label>在庫数</label>
    <input type="number" name="stock"
      value="{{ old('stock', $product->stock) }}">
  </div>


  <div>
    <label>商品画像</label>
    <input type="file" name="img_path">

    @error('img_path')
    <p style="color: red;">{{ $message }}</p>
    @enderror
  </div>

  <button type="submit">更新する</button>
</form>

<a href="/my-products/{{ $product->id }}">戻る</a>

@endsection
