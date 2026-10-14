<h1>新規ユーザー登録</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form action="/register" method="POST">
  @csrf
  <div>
    <label>ユーザー名</label>
    <input type="text" name="name">
  </div>

  <div>
    <label>名前（漢字）</label>
    <input type="text" name="name_kanji">
  </div>

  <div>
    <label>名前（カナ）</label>
    <input type="text" name="name_kana">
  </div>

  <div>
    <label>メールアドレス</label>
    <input type="email" name="email">
  </div>

  <div>
    <label>パスワード</label>
    <input type="password" name="password">
  </div>

  <div>
    <label>パスワード（確認用）</label>
    <input type="password" name="password_confirmation">
  </div>

  <button type="submit">登録</button>
</form>
