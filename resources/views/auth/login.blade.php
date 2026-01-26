<x-guest-layout>
    <x-slot name="title">Sign In - Event Planner</x-slot>

    <x-slot name="leftSide">
        <img src="{{ asset('images/login.jpg') }}"
             class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Background">
        <div class="relative z-10">
            <h2 class="text-4xl font-bold mb-4">Hello Friend</h2>
            <p class="text-gray-200 mb-8 max-w-xs mx-auto">To keep connected with us provide us with your information</p>
            <a href="{{ route('register') }}" 
               class="inline-block px-10 py-3 border-2 border-white rounded-full font-semibold hover:bg-white hover:text-gray-900 transition duration-300">
                Sign up
            </a>
        </div>
    </x-slot>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">Sign In to Event Planner</h2>
    </x-slot>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="aa_email" class="block text-sm font-medium text-gray-700"> Your Email </label>
            <input id="aa_email" type="email" name="aa_email" placeholder="Enter your Email " required autofocus
                   class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]">
            @error('aa_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <!-- Label + Forgot password (same line) -->
            <div class="flex items-center justify-between mb-2">
                <label for="aa_password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-gray-400 hover:text-[#7a49f5] transition">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Input -->
            <input id="aa_password" type="password" name="aa_password"
                   placeholder="Enter your Password" required
                   class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]">

            @error('aa_password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" 
                class="w-full bg-[#7a49f5] text-white font-semibold h-12 rounded-lg hover:bg-[#693de0] transition duration-300 shadow-md">
            Sign In
        </button>
    </form>
</x-guest-layout>
