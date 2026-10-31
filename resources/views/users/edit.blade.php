<h1>アカウント情報編集</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form action="/mypage/edit" method="POST">
  @csrf
  @method('PUT')

  <label>ユーザ名</label>
  <input type="text" name="name" value="{{ $user->name }}">

  <label>Eメール</label>
  <input type="email" name="email" value="{{ $user->email }}">

  <label>名前</label>
  <input type="text" name="name_kanji" value="{{ $user->name_kanji }}">

  <label>カナ</label>
  <input type="text" name="name_kana" value="{{ $user->name_kana }}">

  <button type="button" onclick="location.href='/mypage'">戻る</button>
  <button type="submit">更新</button>
</form>
