@extends('layouts.app')

@section('content')

<h1>商品一覧</h1>

@foreach ($products as $product)
<p>{{ $product->product_name }}</p>
@endforeach

@endsection
