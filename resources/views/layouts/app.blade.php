<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cytech EC</title>

  <style>
    body {
      margin: 0;
      font-family: sans-serif;
    }

    .header-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      border-bottom: 1px solid #ddd;
    }

    .site-name {
      font-size: 20px;
      font-weight: bold;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    nav a {
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>

<body>

  <header>
    <div class="header-inner">
      <div class="site-name">
        Cytech EC
      </div>

      <nav>
        <a href="/">Home</a>
        <a href="#">マイページ</a>
        <span>ログインユーザー: TTUU</span>
        <a href="#">ログアウト</a>
      </nav>
    </div>
  </header>

  <main>
    <!-- 各ページの内容 -->
    @yield('content')
  </main>

  <footer>
    <!-- フッター -->
  </footer>

</body>

</html>
