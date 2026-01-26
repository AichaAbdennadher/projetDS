<x-guest-layout>
    <x-slot name="title">Reset Password - Event Planner</x-slot>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Choose a New Password</h2>
    </x-slot>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="aa_email" :value="__('Email')" />
            <x-text-input id="aa_email" class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]" type="email" name="aa_email" :value="old('aa_email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('aa_email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="aa_password" :value="__('Password')" />
            <x-text-input id="aa_password" class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]" type="password" name="aa_password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('aa_password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="aa_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="aa_password_confirmation" class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]"
                                type="password"
                                name="aa_password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('aa_password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-[#7a49f5] text-white font-semibold h-12 rounded-lg hover:bg-[#693de0] transition duration-300 shadow-md">
            {{ __('Reset Password') }}
        </button>
    </form>
</x-guest-layout>
