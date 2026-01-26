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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Outfit:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans flex flex-col min-h-screen">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-grow">
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
    
      <!-- Footer -->
 <footer class="w-full bg-[#10107a] text-white flex flex-col items-center justify-center py-12">
    <div class="w-full max-w-7xl mx-auto px-6 text-center">
        <!-- Titre -->
        <h2 class="text-3xl font-bold mb-6">
            Event <span class="text-[#7a49f5]">Planner</span>
        </h2>
        
        <!-- Formulaire email -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 max-w-md mx-auto mb-8">
            <input type="email" placeholder="Enter your mail" 
                   class="w-full px-4 py-3 rounded text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#7a49f5]">
            <button class="w-full sm:w-auto px-6 py-3 bg-[#7a49f5] rounded text-sm font-bold hover:bg-[#693de0] transition">
                Subscribe
            </button>
        </div>
        
        <!-- Menu liens -->
        <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-300 mb-8 border-b border-gray-800 pb-4">
            <a href="#" class="hover:text-white transition">Home</a>
            <a href="#" class="hover:text-white transition">Sign Up</a>
            <a href="#" class="hover:text-white transition">Sign In</a>
        </div>
        
  <!-- Ligne séparatrice alignée avec les liens -->
        <div class=" border-b border-white mb-4"></div>
        
        <!-- Copyright -->
        <p class="text-sm text-white ">Non Copyrighted © 2025 Event Planner</p>
    </div>
</footer>
    @stack('scripts')
</body>
</html>
