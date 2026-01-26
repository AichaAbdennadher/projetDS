<div x-data="{ 
    show: true,
    init() {
        setTimeout(() => this.show = false, 4000);
    }
}"
x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-x-full"
x-transition:enter-end="opacity-100 translate-x-0"
x-transition:leave="transition ease-in duration-300"
x-transition:leave-start="opacity-100 translate-x-0"
x-transition:leave-end="opacity-0 translate-x-full"
class="fixed top-4 right-4 z-[9999] max-w-sm w-full pointer-events-auto">
    <div class="rounded-lg shadow-2xl border-l-4 p-4 flex items-center {{ $type === 'success' ? 'bg-green-50 border-green-500 text-green-800' : 'bg-red-50 border-red-500 text-red-800' }}">
        <div class="flex-shrink-0 mr-3">
            @if($type === 'success')
                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            @else
                <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            @endif
        </div>
        <div class="text-sm font-bold">
            {{ $message }}
        </div>
        <button @click="show = false" class="ml-auto text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
