@extends('layouts.app')

@section('content')
<h1>パスワードをお忘れですか？</h1>

<p>登録したメールアドレスを入力してください。パスワード再設定用のリンクを送信します。</p>

@if (session('status'))
<p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('password.email') }}">
  @csrf

  <div>
    <label for="email">メールアドレス</label>
    <input
      type="email"
      id="email"
      name="email"
      value="{{ old('email') }}"
      required
      autocomplete="email">
    @error('email')
    <p>{{ $message }}</p>
    @enderror
  </div>

  <button type="submit">再設定メールを送信</button>
</form>

<p><a href="{{ route('login') }}">ログイン画面に戻る</a></p>
@endsection
