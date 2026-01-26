@extends('layouts.app')
@section('content')
<div class="py-12 flex justify-center">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
        <div class="p-8">
            <h1 class="text-2xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">
                Edit category
            </h1>

            <form method="POST" action="{{ route('admin.categories.update', $category->aa_id) }}">
                @csrf
                @method('PUT')

                <!-- Category Name -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="aa_name">Category name</label>
                    <input type="text" name="aa_name" id="aa_name" value="{{ $category->aa_name }}" placeholder="Enter category name" required
                           class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600
                                  dark:bg-gray-700 dark:text-gray-300
                                  focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    @error('aa_name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center justify-center w-full h-12 rounded-lg border border-[#7a49f5] text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="flex items-center justify-center w-full h-12 rounded-lg bg-[#7a49f5] text-white font-semibold hover:bg-[#693de0] transition shadow-md hover:shadow-lg">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
