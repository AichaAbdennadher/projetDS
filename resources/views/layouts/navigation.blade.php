<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm relative z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <!-- Logo -->
        <p class="text-3xl font-bold text-gray-900 shrink-0">
            Event <span class="text-purple-600">Planner</span>
        </p>

        <!-- Navigation Links & User Menu -->
        <div class="flex items-center space-x-8">
            <!-- App Links (visible depending on role) -->
            @auth
                @if(auth()->user()->aa_role === 'admin')
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? ' font-semibold border-b-2 border-purple-600' : 'text-gray-600 hover:text-gray-900 font-medium' }} pb-1 transition-colors">
                            Categories
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? ' font-semibold border-b-2 border-purple-600' : 'text-gray-600 hover:text-gray-900 font-medium' }} pb-1 transition-colors">
                            Events
                        </a>
                    </div>
                @endif
            @endauth
              @auth
                @if(auth()->user()->aa_role === 'user')
                    <div class="hidden md:flex items-center space-x-6">
                     
                        <a href="{{ route('home') }}" class="{{ (request()->routeIs('home') || request()->routeIs('events.public.show')) ? ' font-semibold border-b-2 border-purple-600' : 'text-gray-600 hover:text-gray-900 font-medium' }} pb-1 transition-colors">
                            Events
                        </a>
                    </div>
                @endif
            @endauth

            <!-- Auth Controls -->
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none py-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->aa_name) }}&background=EBF4FF&color=7F9CF5"
                             alt="User Avatar"
                             class="w-10 h-10 rounded-full border border-gray-200">
                             
                        <div class="text-left hidden md:block">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->aa_name }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 border border-gray-100 ring-1 ring-black ring-opacity-5"
                         style="display: none;">
                        
                        <!-- User info -->
                        <div class="px-4 py-3 border-b border-gray-100 flex items-center gap-3">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->aa_name ?? 'Guest') }}&background=EBF4FF&color=7F9CF5" 
                                     alt="User Avatar"
                                     class="w-10 h-10 rounded-full border border-gray-200">
                                <span class="absolute bottom-0 right-0 block w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>

                            <div class="overflow-hidden">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->aa_name ?? 'Guest' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->aa_email ?? '' }}</p>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">View profile</a>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Registrations</a>
                        
                        <div class="border-t border-gray-100 mt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-[#7a49f5] hover:bg-[#693de0] text-white text-sm font-semibold rounded-lg transition shadow-md hover:shadow-lg">Sign up</a>
                </div>
            @endauth
        </div>
    </div>
</nav>