<h1>商品一覧</h1>

<form action="/logout" method="POST">
  @csrf
  <button type="submit">ログアウト</button>
</form>

@foreach ($products as $product)
<p>{{ $product->product_name }}</p>
@endforeach
