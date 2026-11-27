<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cytech EC</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

  <header>
    <div class="header-inner">
      <div class="site-name">
        Cytech EC
      </div>

      <nav>
        <a href="/products">Home</a>
        <a href="/mypage">マイページ</a>
        @auth
        <span>ログインユーザー: {{ auth()->user()->name }}</span>
        @endauth
        <form action="/logout" method="POST">
          @csrf
          <button type="submit">ログアウト</button>
        </form>
      </nav>
    </div>
  </header>

  <main>
    <!-- 各ページの内容 -->
    @yield('content')
  </main>


  <footer>
    <div style="text-align: center; padding: 24px;">
      <p>
        <button type="button" onclick="location.href='/contact'">お問い合わせ</button>
      </p>

      <p>
        <a href="/products">Home</a>
        <a href="/mypage">マイページ</a>
      </p>

      <hr>

      <small>© 2024 Company, Inc</small>
    </div>
  </footer>


</body>

</html>
