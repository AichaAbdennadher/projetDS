@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div class=" text-gray-900 dark:text-gray-100">

                <h1 class="text-3xl font-bold text-center mb-10">
                    Edit Event
                </h1>

                <form method="POST" action="{{ route('admin.events.update', $event->aa_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Event Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Event Title</label>
                        <input type="text" name="aa_title" placeholder="Title" required
                               value="{{ old('aa_title', $event->aa_title) }}"
                               class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                      dark:bg-gray-700 dark:text-gray-300
                                      focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Category</label>
                        <div class="relative">
                            <select name="aa_category_id" required
                                    class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-gray-300
                                           focus:outline-none focus:ring-1 focus:ring-purple-500
                                           focus:border-purple-500 appearance-none transition">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->aa_id }}" {{ old('aa_category_id', $event->aa_category_id) == $category->aa_id ? 'selected' : '' }}>
                                        {{ $category->aa_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Start date</label>
                            <input type="datetime-local" name="aa_start_date" required
                                   value="{{ old('aa_start_date', $event->aa_start_date->format('Y-m-d\TH:i')) }}"
                                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                          dark:bg-gray-700 dark:text-gray-300
                                          focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">End date</label>
                            <input type="datetime-local" name="aa_end_date" required
                                   value="{{ old('aa_end_date', $event->aa_end_date->format('Y-m-d\TH:i')) }}"
                                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                          dark:bg-gray-700 dark:text-gray-300
                                          focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <!-- Place & Capacity -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Place</label>
                            <input type="text" name="aa_place" placeholder="Place" required
                                   value="{{ old('aa_place', $event->aa_place) }}"
                                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                          dark:bg-gray-700 dark:text-gray-300
                                          focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Capacity</label>
                            <input type="number" min="1" name="aa_capacity" placeholder="Capacity" required
                                   value="{{ old('aa_capacity', $event->aa_capacity) }}"
                                   class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                          dark:bg-gray-700 dark:text-gray-300
                                          focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium mb-2">Pricing</label>
                            <div class="relative">
                                <select id="pricing_type"
                                        class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                               dark:bg-gray-700 dark:text-gray-300
                                               focus:outline-none focus:ring-1 focus:ring-purple-500
                                               focus:border-purple-500 appearance-none transition">
                                    <option value="free" {{ old('aa_is_free', $event->aa_is_free) ? 'selected' : '' }}>Free Access</option>
                                    <option value="paid" {{ !old('aa_is_free', $event->aa_is_free) ? 'selected' : '' }}>Paid</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label id="price_label" class="block text-sm font-medium mb-2 text-gray-300">Amount</label>
                            <input type="number" step="0.01" name="aa_price" id="aa_price"
                                   value="{{ old('aa_price', $event->aa_price) }}"
                                   class="w-full h-12 px-4 rounded-lg border border-gray-200 bg-gray-100
                                          text-gray-300 cursor-not-allowed
                                          focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <input type="hidden" name="aa_is_free" id="aa_is_free" value="{{ old('aa_is_free', $event->aa_is_free) ? '1' : '0' }}">

                    <h1 class="text-3xl font-bold text-center mb-10">
                        Event Description
                    </h1>
                    
                    <!-- Event Image -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium mb-2">Event Image</label>
                        <label id="image-dropzone" for="aa_image"
                               class="flex flex-col items-center justify-center w-full h-52
                                      bg-gray-100 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-600
                                      rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <svg id="camera-icon" class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h3l2-3h8l2 3h3a2 2 0 012 2v9a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                                <circle cx="12" cy="13" r="4"/>
                            </svg>
                            <svg id="check-icon" class="w-12 h-12 mb-3 text-green-500 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <p id="upload-text" class="text-sm text-gray-500 dark:text-gray-300">{{ old('aa_image', basename($event->aa_image)) }}</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (max 5MB)</p>
                            <input id="aa_image" type="file" name="aa_image" accept="image/*" class="hidden">
                        </label>
                    </div>

                    <!-- Event Description -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium mb-2">Event Description</label>
                        <textarea name="aa_description" rows="6" required placeholder="Type here..."
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                                         dark:bg-gray-700 dark:text-gray-300
                                         focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500">{{ old('aa_description', $event->aa_description) }}</textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full text-white py-4 rounded-lg font-semibold" style="background-color:#7a49f5;">
                        Update event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image upload preview
    document.getElementById('aa_image').addEventListener('change', function (e) {
        if (!e.target.files.length) return;
        const fileName = e.target.files[0].name;
        document.getElementById('camera-icon').classList.add('hidden');
        document.getElementById('check-icon').classList.remove('hidden');
        document.getElementById('upload-text').textContent = fileName;
    });

    // Pricing toggle
    document.addEventListener('DOMContentLoaded', () => {
        const pricing = document.getElementById('pricing_type');
        const price = document.getElementById('aa_price');
        const label = document.getElementById('price_label');
        const isFree = document.getElementById('aa_is_free');

        function toggle() {
            if (pricing.value === 'free') {
                price.disabled = true;
                // Don't clear value immediately in edit mode or it wipes existing data if toggled back? 
                // Actually if free, value should be 0 conceptually, but let's just disable it visually.
                // It's safer to clear it if we want to enforce consistency, but user might mis-click.
                // Following create logic: clear it.
                price.value = ''; 
                price.classList.add('bg-gray-100','text-gray-300','cursor-not-allowed');
                label.classList.add('text-gray-300');
                isFree.value = 1;
            } else {
                price.disabled = false;
                price.classList.remove('bg-gray-100','text-gray-300','cursor-not-allowed');
                label.classList.remove('text-gray-300');
                price.classList.add('text-gray-700','dark:text-gray-300');
                isFree.value = 0;
            }
        }

        pricing.addEventListener('change', toggle);
        
        // Run once on load to set initial state correctly
        toggle();
        
        // Restore value if it was paid but logic cleared it? No, blade sets the value.
        // However, if blade set value and we run toggle(), and it's free, it clears it. Correct.
        // If it's paid, blade sets "paid" in select, toggle() runs, enables input, keeps value. Correct.
    });
</script>
@endpush
