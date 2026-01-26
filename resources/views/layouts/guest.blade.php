<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Event Planner' }}</title>
    
    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    @if (session('success'))
        <x-toast type="success" :message="session('success')" />
    @endif
    @if (session('error'))
        <x-toast type="error" :message="session('error')" />
    @endif
    @if (session('status'))
        <x-toast type="success" :message="session('status')" />
    @endif

    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row min-h-[700px]">
        
        <!-- Left Side (Image & Welcome) -->
        <div class="md:w-1/2 relative bg-gray-900 text-white flex flex-col items-center justify-center text-center p-12 order-last md:order-first">
            @if(isset($leftSide))
                {{ $leftSide }}
            @else
                <img src="{{ asset('images/login.jpg') }}"
                     class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Background">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold mb-4">Welcome Back</h2>
                    <p class="text-gray-200 mb-8 max-w-xs mx-auto">To keep connected with us provide us with your information</p>
                    <a href="{{ route('login') }}" 
                       class="inline-block px-10 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition duration-300">
                        Sign In
                    </a>
                </div>
            @endif
        </div>

        <!-- Right Side (Form) -->
        <div class="md:w-1/2 p-12 bg-white flex flex-col justify-center relative">
            
            <div class="text-center mb-10">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Event <span class="text-[#7a49f5]">Planner</span></h3>
                @if(isset($header))
                    {{ $header }}
                @endif
            </div>

            {{ $slot }}
        </div>

    </div>

</body>
</html>
