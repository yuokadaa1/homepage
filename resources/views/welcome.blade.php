<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- bootstrap(cssのみ) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                  <!-- <a href="https://laravel.com/docs" class="disabled">Docs</a> -->
                  <a class="disabled">Docs</a>
                  <!-- <a href="https://laracasts.com" class="disabled">Laracasts</a> -->
                  <a class="disabled">Laracasts</a>
                  <a href={{ url("/twitter") }} class="text-primary">Twitter</a>
                  <a href={{ url("/blog") }} class="text-primary">Blog</a>
                  <a href={{ url("/lesson") }} class="text-primary">Lesson</a>
                  <!-- <a href="https://nova.laravel.com" class="disabled">Nova</a>/ -->
                  <a class="disabled">Nova</a>
                  <!-- <a href="https://forge.laravel.com" class="disabled">Forge</a> -->
                  <a class="disabled">Forge</a>
                  <!-- <a href="https://vapor.laravel.com" class="disabled">Vapor</a> -->
                  <a class="disabled">Vapor</a>
                  <!-- <a href="https://github.com/laravel/laravel" class="disabled">GitHub</a> -->
                  <a class="disabled">GitHub</a>
                  <a href={{ url("/admin") }} class="text-primary">admin</a>
                </div>

                <!-- <div id="menu" class="links">
                  <ul>
                    <li><a href={{ url("/first") }} class="active">初めに</a></li>
                    <li><a href={{ url("/blog") }}>Blog</a></li>
                    <li><a href={{ url("/exchange") }}>為替</a></li>
                    <li><a href={{ url("/zaimu") }}>財務</a></li>
                  </ul>
                </div> -->


            </div>
        </div>
    </body>
</html>
