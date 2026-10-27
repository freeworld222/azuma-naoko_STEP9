@extends('layouts.app')

@section('content')

<h1>商品一覧</h1>

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

<form action="/products" method="GET">
  <div>
    <label>商品名</label>
    <input type="text" name="product_name" value="{{ request('product_name') }}">
  </div>

  <div>
    <label>最低価格</label>
    <input type="number" name="min_price" value="{{ request('min_price') }}">
  </div>

  <div>
    <label>最高価格</label>
    <input type="number" name="max_price" value="{{ request('max_price') }}">
  </div>

  <button type="submit">検索</button>
</form>

<table border="1">
  <thead>
    <tr>
      <th>商品番号</th>
      <th>商品名</th>
      <th>商品説明</th>
      <th>画像</th>
      <th>料金（¥）</th>
      <th>詳細</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->product_name }}</td>
      <td>{{ $product->description }}</td>
      <td>
        @if ($product->img_path)
        <img src="{{ asset('storage/' . $product->img_path) }}"
          alt="{{ $product->product_name }}"
          width="100">
        @endif
      </td>
      <td>{{ $product->price }}</td>
      <td>
        <a href="/products/{{ $product->id }}">詳細</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
