<div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
    <!-- Image -->
    <div class="relative h-48 overflow-hidden">
        <a href="{{ route('events.public.show', $event->aa_id) }}">
            @if($event->aa_image)
                <img src="{{ Str::startsWith($event->aa_image, 'http') ? $event->aa_image : asset('storage/' . $event->aa_image) }}" alt="{{ $event->aa_title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover" alt="Placeholder">
            @endif
        </a>
        
        @if($event->aa_is_free)
            <span class="absolute top-3 left-3 bg-white text-[#7a49f5] text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">
                Free
            </span>
        @endif
    </div>

    <!-- Content -->
    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-2 leading-tight h-12">
            <a href="{{ route('events.public.show', $event->aa_id) }}" class="hover:text-[#7a49f5] transition">
                {{ $event->aa_title }}
            </a>
        </h3>
        
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-[#7a49f5] uppercase">
                {{ $event->aa_start_date->format('l, F d, g.iA') }}
            </p>
            <div class="flex items-center space-x-1">
                @if($event->aa_capacity > 0)
                    <svg class="w-3 h-3 text-[#7a49f5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-[11px] font-semibold text-[#7a49f5]">{{ $event->aa_capacity }} seats left</span>
                @else
                    <span class="text-[11px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded">Full</span>
                @endif
            </div>
        </div>
        <p class="text-[11px] text-gray-500 font-medium line-clamp-2">
            {{ $event->aa_description }}
        </p>
    </div>
</div>
