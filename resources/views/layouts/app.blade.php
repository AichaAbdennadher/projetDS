<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Event Planner</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6">
        @if (session('success'))
            <x-toast type="success" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-toast type="error" :message="session('error')" />
        @endif
        @if (session('status'))
            <x-toast type="success" :message="session('status')" />
        @endif
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>  