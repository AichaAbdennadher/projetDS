<x-guest-layout>
    <x-slot name="title">Forgot Password - Event Planner</x-slot>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Reset Your Password</h2>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>



    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="aa_email" :value="__('Email')" />
            <x-text-input id="aa_email" class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]" type="email" name="aa_email" :value="old('aa_email')" required autofocus />
            <x-input-error :messages="$errors->get('aa_email')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-[#7a49f5] text-white font-semibold h-12 rounded-lg hover:bg-[#693de0] transition duration-300 shadow-md">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>
</x-guest-layout>
