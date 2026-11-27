@extends('layouts.app')

@section('content')
<h1>新しいパスワードを設定</h1>

<form method="POST" action="{{ route('password.update') }}">
  @csrf

  <input type="hidden" name="token" value="{{ $token }}">

  <div>
    <label for="email">メールアドレス</label>
    <input
      type="email"
      id="email"
      name="email"
      value="{{ old('email', $email ?? '') }}"
      required
      autocomplete="email">
    @error('email')
    <p>{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label for="password">新しいパスワード</label>
    <input
      type="password"
      id="password"
      name="password"
      required
      autocomplete="new-password">
    @error('password')
    <p>{{ $message }}</p>
    @enderror
  </div>

  <div>
    <label for="password_confirmation">新しいパスワード（確認）</label>
    <input
      type="password"
      id="password_confirmation"
      name="password_confirmation"
      required
      autocomplete="new-password">
  </div>

  <button type="submit">パスワードを変更する</button>
</form>
@endsection
