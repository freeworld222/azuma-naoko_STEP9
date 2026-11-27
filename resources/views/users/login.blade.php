@extends('layouts.app')

@section('content')
<div class="login-container">
  <div class="login-card">
    <div class="login-card-header">ログイン</div>

    <div class="login-card-body">
      @if ($errors->any())
      <ul class="error-list">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif

      <form action="/login" method="POST">
        @csrf

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}">
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input
            type="password"
            id="password"
            name="password">
        </div>

        <div class="remember-me">
          <label>
            <input type="checkbox" name="remember" value="1">
            このアカウントを記憶する
          </label>
        </div>

        <button type="submit">ログイン</button>
      </form>

      <p>
        <a href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
      </p>
    </div>
  </div>
</div>
@endsection
