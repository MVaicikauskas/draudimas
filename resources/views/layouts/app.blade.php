<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="app" class='bg-success p-2 text-dark bg-opacity-10'>
        <nav class="navbar navbar-expand-md navbar-light bg-success p-2 text-dark bg-opacity-25 shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Prisijungti') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                                </li>
                            @endif
                        @else
                            <a href="{{ url('/home') }}" class="btn btn-success me-md-5 bg-success p-2 text-dark bg-opacity-75">Naujienos</a>
                            @if (Auth::user()->role === 'User')
                                <a class="btn btn-success me-md-5 bg-success p-2 text-dark bg-opacity-75" href="/consultation/create">Registracija Konsultacijai</a>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end bg-success p-2 text-dark bg-opacity-25" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->role === 'Admin')
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/consultations">Konsultacijos</a>
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/products">Produktai</a>
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/users">Sistemos Vartotojai</a>
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/users/show/{{Auth::user()->id}}">Profilis</a>
                                        <hr class="dropdown-divider">
                                        @elseif (Auth::user()->role === 'User')
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/consultations"> Mano Konsultacijos</a>
                                        <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="/users/show/{{Auth::user()->id}}">Profilis</a>
                                        <hr class="dropdown-divider">
                                    @endif
                                    <a class="dropdown-item bg-success p-2 text-dark bg-opacity-50" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Atsijungti') }}
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
            @yield('content')
        </main>
    </div>
</body>
</html>
