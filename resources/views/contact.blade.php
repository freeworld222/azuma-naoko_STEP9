@extends('layouts.app')

@section('content')

<div class="contact-container">

  <h1>お問い合わせフォーム</h1>

  @if ($errors->any())
  <ul class="contact-errors">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <form action="/contact" method="POST" class="contact-form">
    @csrf

    <div class="contact-form-group">
      <label for="name">名前</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>

    <div class="contact-form-group">
      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="contact-form-group">
      <label for="message">お問い合わせ内容</label>
      <textarea id="message" name="message">{{ old('message') }}</textarea>
    </div>

    <div class="contact-form-actions">
      <button type="submit" class="cart-button">送信</button>
      <a href="/products" class="back-button">戻る</a>
    </div>

  </form>

</div>

@endsection
