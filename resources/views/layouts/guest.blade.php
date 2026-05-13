<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    :root {
        --bg: #0a0a0a;
        --card: #111111;
        --border: #1a1a1a;
        --muted: #666666;
        --accent: #E60914;
        --accent-light: #ff3a46;
        --surface: #141414;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Tajawal', sans-serif;
        background: var(--bg);
        color: #ffffff;
        overflow-x: hidden;
    }

    /* Background Effects */
    .page-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 50% at 50% -20%, rgba(230, 9, 20, 0.15), transparent),
            radial-gradient(ellipse 60% 40% at 80% 60%, rgba(230, 9, 20, 0.08), transparent),
            radial-gradient(ellipse 40% 30% at 20% 80%, rgba(230, 9, 20, 0.05), transparent);
    }
</style>

<body>
    <div class="page-bg min-h-screen flex flex-col sm:justify-center px-6 items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <img src="{{ asset('logo.png') }}" class="h-[220px] w-[220px]" />
            </a>
        </div>

        <div class="w-full sm:max-w-md card">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
