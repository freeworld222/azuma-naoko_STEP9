@extends('layouts.app')

@section('content')

<h1>出品商品詳細</h1>

<p>商品名：{{ $product->product_name }}</p>
<p>商品説明：{{ $product->description }}</p>

<p>商品画像：</p>
@if ($product->img_path)
<img
  src="{{ asset('storage/' . $product->img_path) }}"
  alt="{{ $product->product_name }}"
  width="100">
@endif

<p>金額：￥{{ $product->price }}</p>

<a href="/my-products/{{ $product->id }}/edit"
  class="btn btn-primary">編集</a>

<form action="/my-products/{{ $product->id }}" method="POST"
  onsubmit="return confirm('この商品を削除してもよろしいですか？');">
  @csrf
  @method('DELETE')

  <button type="submit">削除する</button>
</form>

<a href="/products" class="btn btn-secondary">戻る</a>

@endsection
