@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 -mt-10 -mx-6" x-data="{ showPasswordModal: false }">
    <!-- Hero Header -->
    <div class="relative h-[480px] flex items-center shadow-lg" style="background-color:#9234eb;">
        <div class="absolute inset-0 opacity-20" style="background-image: url('images/couverture.png'); background-size: cover; background-position: center;"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-extrabold text-white mb-4">Hello {{ explode(' ', Auth::user()->aa_name)[0] }}</h1>
                <p class="text-lg text-white opacity-90 leading-relaxed mb-8">
                    Welcome to your personal event space. Here you can manage your registrations and update your profile informations.
                </p>
                <button @click="showPasswordModal = true; $dispatch('open-modal', 'update-password')" class="inline-flex items-center px-6 py-3 bg-[#E3D2EC] border-2 border-[#7a49f5] text-[#7a49f5] font-bold rounded-lg transition shadow-lg uppercase text-sm tracking-wider hover:bg-purple-50">
                    Edit password
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-6 -mt-32 pb-20 relative z-20">
        <div class="flex flex-wrap -mx-4">
            <!-- Left Column: My Account -->
            <div class="w-full lg:w-8/12 px-4 mb-8">
                <div id="edit-form" class="bg-white rounded-xl shadow-xl overflow-hidden border-0">
                    <div class="flex justify-between items-center p-6 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-[#32325d] uppercase tracking-wide">My account</h2>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="p-8">
                        @csrf
                        @method('patch')
                        
                        <h6 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">User Information</h6>
                        
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full lg:w-6/12 px-3 mb-6 lg:mb-0">
                                <label class="block text-sm font-bold text-[#32325d] mb-2">Username</label>
                                <input type="text" name="aa_name" value="{{ old('aa_name', Auth::user()->aa_name) }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#5e72e4] focus:ring-2 focus:ring-[#5e72e4] focus:ring-opacity-20 transition text-gray-700" placeholder="lucky.jesse">
                            </div>
                            <div class="w-full lg:w-6/12 px-3">
                                <label class="block text-sm font-bold text-[#32325d] mb-2">Email address</label>
                                <input type="email" name="aa_email" value="{{ old('aa_email', Auth::user()->aa_email) }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#5e72e4] focus:ring-2 focus:ring-[#5e72e4] focus:ring-opacity-20 transition text-gray-700" placeholder="jesse@example.com">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-8">
                            <div class="w-full lg:w-6/12 px-3 mb-6 lg:mb-0">
                                <label class="block text-sm font-bold text-[#32325d] mb-2">First name</label>
                                <div class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-gray-500 select-none">
                                    {{ explode(' ', Auth::user()->aa_name)[0] }}
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-3">
                                <label class="block text-sm font-bold text-[#32325d] mb-2">Last name</label>
                                <div class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-gray-500 select-none">
                                    {{ count(explode(' ', Auth::user()->aa_name)) > 1 ? explode(' ', Auth::user()->aa_name)[1] : '' }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-center pt-6 border-t border-gray-100">
                             <button type="submit" class="px-6 py-3 bg-[#32325d] hover:bg-[#32325d] text-white  font-bold rounded-lg transition shadow-lg text-sm uppercase tracking-wider">
                                Save Profile
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Right Column: Profile Stats Card -->
            <div class="w-full lg:w-4/12 px-4">
                <div class="bg-white rounded-xl shadow-xl overflow-visible border-0 relative pt-24 pb-8 px-8 text-center">
                    <!-- Avatar -->
                    <div class="absolute -top-20 left-1/2 transform -translate-x-1/2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->aa_name) }}&size=150&background=b9bfc7&color=fff" 
                             alt="Avatar" 
                             class="w-40 h-40 rounded-full border-4 border-white shadow-2xl object-cover">
                    </div>

                    <!-- Stats Section -->
                    <div class="flex justify-between items-center mb-8">
                        <div class="text-left flex items-baseline space-x-2">
                            <span class="text-2xl font-bold text-[#32325d]">
                                {{ Auth::user()->aa_role === 'admin' ? \App\Models\Registration::count() : Auth::user()->registrations()->count() }}
                            </span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Registrations</span>
                        </div>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#32325d] hover:bg-[#32325d] text-white rounded-lg text-xs font-bold uppercase transition shadow-md hover:shadow-lg">
                            {{ Auth::user()->aa_role === 'admin' ? 'All Registrations' : 'My registrations' }}
                        </a>
                    </div>

                    <!-- Info -->
                    <div class="space-y-2">
                        <h3 class="text-2xl font-bold text-[#32325d]">{{ Auth::user()->aa_name }}</h3>
                     
                        <p class="text-gray-500 font-medium pb-4">{{ Auth::user()->aa_role === 'admin' ? 'Administrator' : 'Event Participant' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Password Update Modal -->
    <x-modal name="update-password" :show="false" @close="showPasswordModal = false" maxWidth="lg">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-center w-full text-gray-900 dark:text-gray-100">
                    Update Password
                </h3>
                <button @click="$dispatch('close-modal', 'update-password')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            @include('profile.partials.update-password-form')
        </div>
    </x-modal>
</div>

<style>
    /* Prevent collisions with the background */
    nav { background-color: white !important; }
</style>
@endsection
