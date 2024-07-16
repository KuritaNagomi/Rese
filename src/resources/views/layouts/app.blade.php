<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>
<body class="body">
    <header class="header">
        <div class="header__left">
            <a href="/menu" class="to_menu">
                <button class="hamburger">
                    <span class="hamburger_bar"></span>
                    <span class="hamburger_bar"></span>
                    <span class="hamburger_bar"></span>
                </button>
            </a>
            <h1 class="header-ttl">Rese</h1>
        </div>
        <div class="header__right">@yield('search')</div>
    </header>
    <main class="main">
        @yield('content')
    </main>
</html>