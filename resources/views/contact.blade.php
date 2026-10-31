@extends('layouts.app')

@section('content')

<h1>お問い合わせ</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form action="/contact" method="POST">
  @csrf
  <div>
    <label>名前</label>
    <input type="text" name="name">
  </div>

  <div>
    <label>メールアドレス</label>
    <input type="email" name="email">
  </div>

  <div>
    <label>お問い合わせ内容</label>
    <textarea name="message"></textarea>
  </div>

  <button type="submit">送信</button>
</form>

<a href="/products">戻る</a>

@endsection
