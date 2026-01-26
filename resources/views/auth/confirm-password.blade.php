<x-guest-layout>
    <x-slot name="title">Confirm Password - Event Planner</x-slot>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Secure Area</h2>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="aa_password" :value="__('Password')" />
            <x-text-input id="aa_password" class="w-full bg-gray-50 border-none rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5]"
                            type="password"
                            name="aa_password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('aa_password')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-[#7a49f5] text-white font-semibold h-12 rounded-lg hover:bg-[#693de0] transition duration-300 shadow-md">
            {{ __('Confirm') }}
        </button>
    </form>
</x-guest-layout>
