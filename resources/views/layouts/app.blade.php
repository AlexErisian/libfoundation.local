<!doctype html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<div id="app" class="flex-shrink-0">
    <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h3 class="text-white">{{ config('app.name') }}</h3>
            </a>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-light"
                           href="{{ route('login') }}">{{ __('Увійти') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-light"
                               href="{{ route('register') }}">{{ __('Зареєструватися') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown"
                           class="nav-link dropdown-toggle text-light"
                           href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-right position-absolute"
                            aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-danger"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ __('Вийти') }}
                            </a>
                            <form id="logout-form"
                                  class="d-none"
                                  action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main class="py-2" role="main">
        <div class="row justify-content-center m-0">
            <div class="col-xl-2 col-md-3 px-0">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ul class="navbar-nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link @if(URL::current() == route('main')) active @endif"
                                   href="{{ route('main') }}">
                                    {{ __('Головна') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{-- @if(URL::current() == route('')) active @endif--}}"
                                   href="">
                                    {{ __('Друковані видання') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{-- @if(URL::current() == route('')) active @endif--}}"
                                   href="">
                                    {{ __('Бібліотеки') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{-- @if(URL::current() == route('')) active @endif--}}"
                                   href="">
                                    {{ __('Про систему') }}
                                </a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link{{-- @if(URL::current() == route('')) active @endif--}}"
                                       href="">
                                        {{ __('Панель бібліотекара') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(URL::current() == route('admin.panel')) active @endif"
                                       href="{{ route('admin.panel') }}">
                                        {{ __('Панель адміністратора') }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </main>
</div>
<footer class="d-block mt-auto">
    <div class="w-100 p-3 bg-primary text-white text-center">
        <h5>Бібліотечна система {{ config('app.name') }} (c) 2020 | Developed by
            garabox@ukr.net</h5>
    </div>
</footer>
</body>
</html>
