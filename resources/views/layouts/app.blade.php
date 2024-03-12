<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand shadow-sm mb-3">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a> --}}
                            <a class="nav-link" href="http://localhost:5174/">
                                <img class="logo" src="../../../../images/BoolBnb.png" alt="">
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle user-logo-a" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <span
                                        class="user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                    <i class="fa-solid fa-user user-logo"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.apartments.index') }}">{{ __('Apartments') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.orders.index') }}">{{ __('Sponsorship') }}</a>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.messages.index') }}">{{ __('Messages') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="main">
            @yield('content')
            @stack('scripts')
            <script src="https://kit.fontawesome.com/051fa5e347.js" crossorigin="anonymous"></script>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="text-center p-2 mb-0">
                    <p class="title-footer mb-1">BoolBnb made by Team 1, Boolean class 106 :</p>
                    <div class=" list-creator mt-0 d-flex justify-content-between">
                        <a href="https://github.com/aSwanting" target="_blank" class="name-creator">
                            <div>Gabriel D'Amico</div>
                        </a>
                        <a href="https://github.com/ValerioCarbone" target="_blank" class="name-creator">
                            <div>Valerio Carbone</div>
                        </a>
                        <a href="https://github.com/EmanueleVenditti95" target="_blank" class="name-creator">
                            <div>Emanuele Venditti</div>
                        </a>
                        <a href="https://github.com/w3bd3v3lop3rNico" target="_blank" class="name-creator">
                            <div>Nicola Tabai</div>
                        </a>
                        <a href="https://github.com/karimdib" target="_blank" class="name-creator">
                            <div>Karim Dib</div>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
<style>
    .logo {
        width: 100px;
    }

    .dropdown-item {}

    .nav-item a {
        padding: 0 !important;
    }

    .dropdown-menu {
        --bs-dropdown-min-width: 0;
        padding: 10px;
    }

    @media (min-width: 576px) {
        .nav-item a {
            padding: 10px 50px !important;
        }

        .dropdown-menu {
            --bs-dropdown-min-width: 10rem;
            padding: 0;
        }
    }


    @media (min-width: 768px) {
        .logo {
            width: 160px;
        }
    }


    @media (min-width: 992px) {
        ...
    }


    @media (min-width: 1200px) {
        ...
    }


    @media (min-width: 1400px) {
        ...
    }
</style>
