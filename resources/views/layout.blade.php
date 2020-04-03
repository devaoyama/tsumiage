<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@maru_prog" />
    <meta property="og:url" content="https://tsumiage.work" />
    <meta property="og:title" content="積み上げくん" />
    <meta property="og:description" content="#今日の積み上げを「積み上げくん」で管理しよう！！" />
    <meta property="og:image" content="images/main.jpeg" />

    <title>積み上げくん</title>

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />
    <style>
        .done {
            text-decoration: line-through;
        }
        .main {
            margin-top: 56px;
            margin-bottom: 40px;
        }
        .navbar {
            opacity: 0.9;
        }
        footer {
            opacity: 0.9;
            font-size: 18px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="/">積み上げくん</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                @if(Auth::check())
                    <img src="{{ Auth::user()->avatar }}" alt="アバター" class="rounded-circle" width="30" height="30">
                @else
                    <span class="navbar-toggler-icon"></span>
                @endif
            </button>

            <div class="collapse navbar-collapse" id="navbarNav4">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('/')) active @endif" href="{{ route('home') }}">TOP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::is('board')) active @endif" href="{{ route('board') }}">掲示板</a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link @if(Request::is('mypage') || Request::is('mypage/tweet*')) active @endif" href="{{ route('mypage') }}">マイページ</a>
                        </li>
                        <li>
                            <a class="nav-link @if(Request::is('mypage/config')) active @endif" href="{{ route('config.index') }}">設定</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="main">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white fixed-bottom">
        <div class="container">
            <div class="d-flex justify-content-around">
                <div>
                    <p class="overflow-hidden mb-0">© 2020 マル. All rights reserved.</p>
                </div>
                <div>
                    <div class="float-right">
                        <a href="https://twitter.com/maru_prog" class="text-primary"><i class="fab fa-twitter mx-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
