<x-guest-layout>
    <x-slot name="title">Verify Email - Event Planner</x-slot>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Verify Your Email</h2>
    </x-slot>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-8 flex flex-col space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-[#7a49f5] text-white font-semibold h-12 rounded-lg hover:bg-[#693de0] transition duration-300 shadow-md">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
