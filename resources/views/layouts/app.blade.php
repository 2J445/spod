<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('image/logo2.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- google関連 -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!--css-->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/contact.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="body" style="background: black;">
    <div class="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <div class="spod-logo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('image/logo.png')}}">
                    </a>
                </div>
                <div class="search-form">
                  <form action="{{ route('post.index') }}" method="GET">
                    <input type="text" name="keyword" value="{{ $keyword??"" }}" class="search-bar">
                    <input type="submit" value="検索" class="search-btn">
                  </form>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <p><a class="nav-link" href="{{ route('register') }}">{{ __('アカウント登録') }}</a></p>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if($user->admin == true)
                                        <a href="{{ route('user.index') }}" class="dropdown-item">ユーザー一覧</a>
                                    @else
                                        <a href="{{ route('user.index') }}" class="dropdown-item">チェッカー配信</a>
                                    @endif
                                    <a href="{{ route('user.show', $user->id) }}" class="dropdown-item">マイページ</a>
                                    <a href="{{ route('post.create') }}" class="dropdown-item">アップロード</a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item">設定</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class='wrap'>
                @yield('content')
            </div>
        </main>
    </div>
    <footer>
        <div class="footer-btn">
            <div class="contact-btn">
                <a href="{{ route('contact.index') }}" class="dropdown-item">お問い合わせ</a>
            </div>
        </div>
        <p>© spod.2023.</p>
    </footer>
</body>
</html>
