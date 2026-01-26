@extends('layouts.site')

@section('content')
    <div class="pt-6">
        <!-- Hero Section (Restored spacing) -->
        <div class="max-w-[1320px] mx-auto mb-12">
            <div class="relative w-full h-[500px] rounded-[10px] overflow-hidden shadow-2xl mx-auto"
                 x-data="{
                    activeSlide: 0,
                    slides: [{ img: 'images/couverture.png', title: 'Made for those <br> who do'},
                        { img: 'images/f.jpg',  title: 'Create Memories <br> That Last' },                
                    ],
                    next() {
                        this.activeSlide = (this.activeSlide === this.slides.length - 1) ? 0 : this.activeSlide + 1;
                    },
                    prev() {
                        this.activeSlide = (this.activeSlide === 0) ? this.slides.length - 1 : this.activeSlide - 1;
                    }
                 }">
                
                <!-- Image with transition -->
                <template x-for="(slide, index) in slides" :key="index">
                    <img :src="slide.img" 
                         x-show="activeSlide === index"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform scale-105"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         alt="Hero" 
                         class="absolute inset-0 w-full h-full object-cover">
                </template>
                
                <!-- Overlay Title with Grid Specs -->
                <div class="absolute inset-0 z-10 pointer-events-none">
                    <h1 class="absolute text-white tracking-[0] uppercase text-center drop-shadow-lg"
                        style="width: 800px; top: 100px; left: 50%; transform: translateX(-50%); font-family: 'Inter', sans-serif; font-weight: 700; font-size: 48px; line-height: 110%;"
                        x-html="slides[activeSlide].title"
                        x-transition:enter="transition ease-out duration-500 delay-200"
                        x-transition:enter-start="opacity-0 transform translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0">
                    </h1>
                </div>

                <!-- Slider Arrows -->
                <button @click="prev()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white backdrop-blur-sm transition z-20 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white backdrop-blur-sm transition z-20 focus:outline-none">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
                
                <!-- Dots Indicators -->
                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index" 
                                class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                :class="activeSlide === index ? 'bg-white w-6' : 'bg-white/50 hover:bg-white/80'">
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <div class="max-w-[1200px] mx-auto h-[44px] mb-8 bg-transparent">
            <form action="{{ route('home') }}" method="GET" class="flex justify-between items-center h-full">
                <!-- Title -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 leading-none">
                        Upcoming <span class="text-[#7a49f5]">Events</span>
                    </h2>
                </div>
                
                <!-- Filters -->
                <div class="flex gap-3 h-full items-center">
                    <!-- Search selon title et description -->
                    <div class="relative h-full">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                               class="w-64 h-full pl-4 pr-10 bg-gray-100 border-none rounded-lg text-sm focus:ring-2 focus:ring-[#7a49f5]">
                        <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <!-- Weekdays Dropdown -->
                    <div class="relative h-full">
                        <select name="date_filter" onchange="this.form.submit()" class="appearance-none w-32 h-full pl-4 pr-10 bg-gray-100 border-none rounded-lg text-sm text-gray-600 focus:ring-2 focus:ring-[#7a49f5]">
                            <option value="">Any Date</option>
                            <option value="Weekdays" {{ request('date_filter') == 'Weekdays' ? 'selected' : '' }}>Weekdays</option>
                            <option value="Weekends" {{ request('date_filter') == 'Weekends' ? 'selected' : '' }}>Not Weekends</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Category Dropdown -->
                     <div class="relative h-full">
                        <select name="category_id" onchange="this.form.submit()" class="appearance-none w-36 h-full pl-4 pr-10 bg-gray-100 border-none rounded-lg text-sm text-gray-600 focus:ring-2 focus:ring-[#7a49f5]">
                            <option value="">Any category</option>
                             @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->aa_id }}" {{ request('category_id') == $cat->aa_id ? 'selected' : '' }}>{{ $cat->aa_name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<!-- Le header X-Requested-With permet à Laravel de détecter :request()->ajax() -->
        <!-- Events Grid  -->
        <div class="max-w-[1200px] mx-auto mb-16" 
             x-data="{ 
                nextPageUrl: '{{ $events->nextPageUrl() }}',
                isLoading: false,
                loadMore() {
                    if (!this.nextPageUrl || this.isLoading) return;
                    this.isLoading = true;
                    
                    fetch(this.nextPageUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.$refs.eventsContainer.insertAdjacentHTML('beforeend', data.html);
                        this.nextPageUrl = data.next_page_url;
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.isLoading = false;
                    });
                }
             }">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[20px]" x-ref="eventsContainer">
                @foreach ($events as $event)
                    @include('events.partials.event_card', ['event' => $event])
                @endforeach
            </div>

            <div class="max-w-[1200px] mx-auto mt-16 mb-20 flex justify-center" x-show="nextPageUrl">
                <button @click="loadMore()" 
                        :disabled="isLoading"
                        class="w-[133px] h-[49px] rounded-[5px] flex items-center justify-center gap-[10px] bg-[#7848F4] text-white font-bold border border-[#7848F4] hover:bg-[#693de0] transition duration-300 disabled:opacity-50">
                    <span x-show="!isLoading">Load more....</span>
                    <span x-show="isLoading">Loading...</span>
                </button>
            </div>
        </div>





@endsection
