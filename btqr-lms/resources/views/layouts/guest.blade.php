<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BTQR LMS') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: linear-gradient(135deg, #0d4d28 0%, #1a6b3a 50%, #145530 100%); min-height: 100vh; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="text-center mb-6">
            <div class="text-5xl mb-2">🕌</div>
            <div class="text-white font-bold text-xl">BTQR LMS</div>
            <div class="text-white/70 text-sm">Bait Tahfiz Al-Quran Ridhallah</div>
        </div>
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>
        <p class="mt-6 text-white/50 text-xs">© 2026 BTQR &bull; Powered by Laravel 12</p>
    </div>
</body>
</html>
