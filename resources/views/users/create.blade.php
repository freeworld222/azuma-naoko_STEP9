@extends('layouts.app')

@section('content')
<div class="register-container">
  <div class="register-card">
    <h1>Register</h1>

    @if ($errors->any())
    <ul class="register-errors">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form action="/register" method="POST">
      @csrf

      <div class="register-form-group">
        <label>Name（ユーザー名）</label>
        <input type="text" name="name" value="{{ old('name') }}">
      </div>

      <div class="register-form-group">
        <label>名前（漢字）</label>
        <input type="text" name="name_kanji" value="{{ old('name_kanji') }}">
      </div>

      <div class="register-form-group">
        <label>名前（カナ）</label>
        <input type="text" name="name_kana" value="{{ old('name_kana') }}">
      </div>

      <div class="register-form-group">
        <label>Email Adress</label>
        <input type="email" name="email" value="{{ old('email') }}">
      </div>

      <div class="register-form-group">
        <label>Password</label>
        <input type="password" name="password">
      </div>

      <div class="register-form-group">
        <label>Comfirm Password</label>
        <input type="password" name="password_confirmation">
      </div>

      <button type="submit">Register</button>
    </form>
  </div>
</div>
@endsection
