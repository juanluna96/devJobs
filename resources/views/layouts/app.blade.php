<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/dist/devjobs.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">

    @if (session('message'))
        <div class="bg-teal-500 p-8 text-center text-white font-bold uppercase">
            {{ session('message') }}
        </div>
    @endif

    <div id="app">
        <nav class="bg-blue-900 shadow py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="text-3xl font-semibold text-white no-underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="flex-1 text-right">
                        @guest
                            <a class="no-underline hover:underline hover:text-gray-300 text-white text-sm p-3"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline hover:text-gray-300 text-white text-sm p-3"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <a href="{{ route('notificaciones') }}"
                                    class="bg-teal-500 rounded-full mr-2 px-2 py-1 font-bold text-sm text-white">{{ Auth::user()->unreadNotifications->count() }}</a>
                            @endif

                            <a href="{{ route('logout') }}"
                                class="no-underline hover:underline hover:text-gray-300 text-white text-sm p-3"
                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <div class="bg-gray-700 mb-8">
            <div class="container mx-auto flex space-x-1 flex-col text-center md:flex-row">
                @yield('navegacion')
            </div>
        </div>
        <main class="mt-10 container mx-auto">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>
