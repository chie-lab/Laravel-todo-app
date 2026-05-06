<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Todo App')</title>
        <link rel="stylesheet" href="{{ asset('css/todos.css') }}">
    </head>
    <body>
        @auth
            <header class="site-header">
                <span class="site-header-user">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="site-header-logout">
                    @csrf
                    <button type="submit" class="logout-button">ログアウト</button>
                </form>
            </header>
        @endauth
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
        <script src="{{ asset('js/todos.js') }}"></script>
        @stack('scripts')
    </body>
</html>
