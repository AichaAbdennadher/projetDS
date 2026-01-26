@extends('layouts.site')

@section('content')
    <div class="min-h-screen bg-[#F8F9FA]" x-data="{ showModal: false }">
        <div class="max-w-[1320px] mx-auto px-[60px] pt-8">
            
            <!-- Event Hero -->
            <div class="relative w-full max-w-[1320px] h-[500px] rounded-[10px] overflow-hidden mb-12 group" style="background: rgba(19, 19, 21, 0.5);">
                <!-- Image -->
         
                    <img src="{{ asset('storage/' . $event->aa_image) }}" alt="{{ $event->aa_title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
               
                
                <!-- Overlay Gradient -->
                <div class="absolute inset-0" style="background: rgba(19, 19, 21, 0.5);"></div>

                <!-- Header Content (Stacked Vertically) -->
                <div class="absolute top-[30px] left-[60px] right-[60px] z-20 flex flex-col items-start gap-6">
                    <!-- Back Button -->
                    <a href="{{ route('home') }}" class="shrink-0 flex items-center justify-center gap-[5px] w-[83px] h-[40px] bg-[#7a49f5] rounded-[5px] text-white hover:bg-[#693de0] transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Back
                    </a>

                    <!-- Event Info -->
                    <div class="flex flex-col gap-4">
                        <h1 class="text-5xl md:text-6xl font-semibold text-white leading-tight">{{ $event->aa_title }}</h1>
                        
                        <div class="flex items-center gap-2 text-2xl text-gray-200 font-semibold">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $event->aa_place }}</span>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-300 leading-relaxed max-w-2xl">
                            {{ Str::limit($event->aa_description, 250) }}
                        </p>
                        
                        <div class="mt-2 text-white">
                            @auth
                                @if(!$event->registrations()->where('aa_user_id', auth()->id())->exists() && $event->aa_capacity > 0)
                                    <button @click="showModal = true; $dispatch('open-modal', 'book-event')" class="px-8 py-3 bg-[#7a49f5] text-white rounded-lg font-bold hover:bg-[#693de0] transition shadow-lg hover:shadow-purple-500/30">
                                        Book now
                                    </button>
                                @elseif($event->registrations()->where('aa_user_id', auth()->id())->exists())
                                    <span class="px-8 py-3 bg-green-600 rounded-lg font-bold inline-block">You are attending</span>
                                @elseif($event->aa_capacity <= 0)
                                    <span class="px-8 py-3 bg-gray-500 rounded-lg font-bold inline-block">Sold Out</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-[#7a49f5] text-white rounded-lg font-bold hover:bg-[#693de0] transition inline-block">
                                    Login to Book
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="flex flex-col md:flex-row w-[964px] gap-[120px] ml-[60px] mt-8 mb-0">
                <!-- Description -->
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Description</h3>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {{ $event->aa_description }}
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Hours</h3>
                        <p class="text-sm text-gray-600 mb-2">Start hour : <span class="text-[#7a49f5] font-bold">{{ $event->aa_start_date->format('M d, Y , h:i A') }}</span></p>
                        <p class="text-sm text-gray-600">End hour : <span class="text-[#7a49f5] font-bold">{{ $event->aa_end_date->format('M d, Y , h:i A') }}</span></p>
                    </div>
                    
                    <div>
                         <h3 class="text-xl font-bold text-gray-900 mb-4">Capacity</h3>
                         <p class="text-sm text-gray-600">Seats number : <span class="text-[#7a49f5] font-bold">{{ $event->aa_capacity }} persons</span></p>
                    </div>
                </div>
            </div>

            <!-- Related Events -->
            @if($relatedEvents->count() > 0)
            <div class="mb-12 ml-[60px] w-[964px] mt-12">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Other events you may like</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedEvents as $related)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden">
                                <a href="{{ route('events.public.show', $related->aa_id) }}">
                                    @if($related->aa_image)
                                        <img src="{{ asset('storage/' . $related->aa_image) }}" alt="{{ $related->aa_title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover" alt="Placeholder">
                                    @endif
                                </a>
                                
                                @if($related->aa_is_free)
                                    <span class="absolute top-3 left-3 bg-white text-[#7a49f5] text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">
                                        Free
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-2 leading-tight h-12">
                                    <a href="{{ route('events.public.show', $related->aa_id) }}" class="hover:text-[#7a49f5] transition">
                                        {{ $related->aa_title }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <p class="text-xs font-semibold text-[#7a49f5] uppercase">
                                        {{ $related->aa_start_date->format('l, F d, g.iA') }}
                                    </p>
                                    <div class="flex items-center space-x-1">
                                        @if($related->aa_capacity > 0)
                                            <svg class="w-3 h-3 text-[#7a49f5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            <span class="text-[10px] font-semibold text-[#7a49f5]">{{ $related->aa_capacity }} seats left</span>
                                        @else
                                            <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded">Full</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-[11px] text-gray-500 font-medium line-clamp-2">
                                    {{ $related->aa_description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- Book Event Modal -->
        <x-modal name="book-event" :show="false" @close="showModal = false">
            <div class="p-6 text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Book Event</h3>
                
                <form action="{{ route('events.register', $event->aa_id) }}" method="POST">
                    @csrf
                    <div class="flex space-x-4 mt-6">
                        <button type="button" @click="$dispatch('close-modal', 'book-event')" class="flex-1 py-3 bg-white border-2 border-[#7a49f5] rounded-lg text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 py-3 bg-[#7a49f5] text-white rounded-lg font-bold hover:bg-[#693de0] transition shadow-md">
                            Book now
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>

    </div>
@endsection
