<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center gap-4">
        <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
        @if (Route::has('login'))
            <nav class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="underline">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</body>
</html>