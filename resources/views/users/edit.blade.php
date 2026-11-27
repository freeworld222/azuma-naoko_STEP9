@extends('layouts.app')

@section('content')

<div class="account-edit-container">

  <h1>アカウント情報編集</h1>

  @if ($errors->any())
  <ul class="account-edit-errors">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <form action="/mypage/edit" method="POST" class="account-edit-form">
    @csrf
    @method('PUT')

    <div class="account-edit-group">
      <label for="name">ユーザ名</label>
      <input type="text" id="name" name="name"
        value="{{ old('name', $user->name) }}">
    </div>

    <div class="account-edit-group">
      <label for="email">Eメール</label>
      <input type="email" id="email" name="email"
        value="{{ old('email', $user->email) }}">
    </div>

    <div class="account-edit-group">
      <label for="name_kanji">名前</label>
      <input type="text" id="name_kanji" name="name_kanji"
        value="{{ old('name_kanji', $user->name_kanji) }}">
    </div>

    <div class="account-edit-group">
      <label for="name_kana">カナ</label>
      <input type="text" id="name_kana" name="name_kana"
        value="{{ old('name_kana', $user->name_kana) }}">
    </div>

    <div class="account-edit-actions">
      <a href="/mypage" class="back-button">戻る</a>
      <button type="submit" class="cart-button">更新</button>
    </div>

  </form>

</div>

@endsection
