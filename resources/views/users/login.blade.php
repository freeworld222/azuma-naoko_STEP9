<h1>ログイン</h1>

<!-- エラーの際の表示 -->
@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form action="/login" method="POST">
  @csrf

  <div>
    <label>メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}">
  </div>

  <div>
    <label>パスワード</label>
    <input type="password" name="password">
  </div>

  <button type="submit">ログイン</button>
</form>

<p>
  <a href="/register">新規ユーザー登録はこちら</a>
</p>
