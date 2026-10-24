@extends('layouts.app')

@section('content')

<h1>商品詳細</h1>

<p>商品名：{{ $product->product_name }}</p>
<p>説明：{{ $product->description }}</p>
<p>画像：{{ $product->img_path }}</p>
<p>金額：￥{{ $product->price }}</p>
<p>会社：{{ $product->company->company_name ?? '会社情報なし' }}</p>

<form action="/products/{{ $product->id }}/like" method="POST">
  @csrf
  <button type="submit"
    style="color: {{ $isLiked ? 'red' : 'white' }};">
    ♥
  </button>
</form>

<form action="/products/{{ $product->id }}/purchase" method="GET">
  <button type="submit">カートに追加する</button>
</form>

<a href="/products">戻る</a>

@endsection
