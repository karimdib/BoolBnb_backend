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
                            <a class="nav-link" href="http://localhost:5174/">boolbnb</a>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" href="{{ route('admin.apartments.index') }}">{{
                                    __('Apartments') }}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="">
            @yield('content')
            @stack('scripts')
        </main>
        <footer class="ff">
            <div class="container">
                <div class="row  justify-content-between flex-wrap  flex-md-nowrap">
                    <div class="col-md-4 col-6">
                        <ul>
                            <a href="#">
                                <li>Chi Siamo</li>
                            </a>
                            <a href="#">
                                <li>Contatti</li>
                            </a>
                            <a href="#">
                                <li>Pubblica il tuo annuncio</li>
                            </a>
                            <a href="#">
                                <li>Lavora con noi</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-md-4 col-6">
                        <ul>
                            <a href="#">
                                <li>Termini di utilizzo</li>
                            </a>
                            <a href="#">
                                <li>Normativa sulla privacy e sui cookie</li>
                            </a>
                            <a href="#">
                                <li>Appartamenti vicino a me </li>
                            </a>
                            <a href="#">
                                <li>Domande Frequenti</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-md-4 col-12  text-center icon-col ">
                        <ul>
                            <a href="#">
                                <li class="icon">Seguici su:</li>
                            </a>
                        </ul>
                        <ul class="d-flex gap-3  justify-content-center justify-content-md-between p-0">
                            <a href="#">
                                <li class="icon">
                                    <font-awesome-icon :icon="['fab', 'facebook']" />
                                </li>
                            </a>
                            <a href="#">
                                <li class="icon">
                                    <font-awesome-icon :icon="['fab', 'instagram']" />
                                </li>
                            </a>
                            <a href="#">
                                <li class="icon">
                                    <font-awesome-icon :icon="['fab', 'github']" />
                                </li>
                            </a>
                            <a href="#">
                                <li class="icon">
                                    <font-awesome-icon :icon="['fab', 'telegram']" />
                                </li>
                            </a>
                        </ul>
                    </div>
                    <!-- <div class="col-12">
                  <img class="city-image" src="/public/cityy.png" alt="">
                </div> -->
                </div>
            </div>
        </footer>
    </div>
</body>

</html>