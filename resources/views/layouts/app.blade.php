<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('style')

        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/acd4b236b1.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-home">
                    <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt=""><span @if(request()->is('home')) class="current-route" @endif>Parvifolium</span></a>
                </div>

                <div class="nav-links">
                    <a href="{{ route('posts') }}" @if(request()->is('posts')) class="current-route" @endif>Posts</a>
                    <a href="{{ route('about') }}" @if(request()->is('about')) class="current-route" @endif>About</a>
                </div>
            </nav>
        </header>
        
        <main>@yield('main')</main>

        <footer>Parvifolium © 2021 Blaine Bush</footer>

        <!-- Scripts -->
        @stack('script')
    </body>
</html>
