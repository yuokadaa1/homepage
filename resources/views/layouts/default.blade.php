<html lang="ja">
<!DOCTYPE HTML>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- cdnで設定する場合 -->
  <!-- bootstrap.css -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
  <!-- bootstrap.jsの使用にはjquery.jsが必須（jqueryが先） -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script> -->

  <!-- Laravel 6.x laravel/uiを試そうとしたらinstallされてしまった。 -->
  <!-- https://blog.hrendoh.com/laravel-6-setup-bootstrap4-with-laravel-ui/ -->
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Laravel 6.x laravel/uiを試そうとしたらinstallされてしまった。 -->


  <!-- 読込は下が先 -->
  <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


  @yield('styles')

</head>
<body>

<!--=================================================
Navbar
==================================================-->

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <!-- <a class="navbar-brand" href="#">@yield('title')</a> -->
  <!-- <a class="navbar-brand" href="#">適当な私の適当なマイブログ（誤用）</a> -->
  <a class="navbar-brand" href={{ url("/blog") }}>適当な私の適当なマイブログ（誤用）</a>

  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="Navber">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">ホーム <span class="sr-only">(現位置)</span></a> -->
        <a class="nav-link" href={{ url("/") }}>ホーム <span class="sr-only">(現位置)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">リンク</a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ドロップダウン
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">メニュー1</a>
          <a class="dropdown-item" href="#">メニュー2</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">その他</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">無効</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input type="search" class="form-control mr-sm-2" placeholder="検索..." aria-label="検索...">
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
    </form>
  </div><!-- /.navbar-collapse -->
</nav>

<div class="container" style="margin-top: 10px;">
  @yield('content')
</div><!-- /.container -->

<footer class="footer">
  <div class="container">
  <p class="text-muted">@yield('title')</p>
  </div>
</footer>

<!-- Bootstrap core JavaScript
  ================================================== -->

@yield('scripts')
</body>
</html>
