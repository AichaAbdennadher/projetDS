@extends('layouts.app')

@section('content')
<div class="py-12" x-data="{ 
    createOpen: {{ $errors->has('create_aa_name') ? 'true' : 'false' }}, 
    editOpen: {{ $errors->has('edit_aa_name') ? 'true' : 'false' }}, 
    deleteOpen: false,
    editUrl: '',
    editName: '',
    deleteUrl: '',
    
    openEdit(url, name) {
        this.editUrl = url;
        this.editName = name;
        this.editOpen = true;
    },
    
    openDelete(url) {
        this.deleteUrl = url;
        this.deleteOpen = true;
    }
}">
    <div class="max-w-7xl mx-auto sm:px-5 lg:px-3" x-init="
        if (createOpen) { $dispatch('open-modal', 'create-category') }
        if (editOpen) { $dispatch('open-modal', 'edit-category') }
    ">
        <h2 class="font-bold text-3xl leading-tight mb-6 text-[#7a49f5]">
            List of Categories
        </h2>
        
        <div class="mb-4 flex justify-end">
            <button @click="$dispatch('open-modal', 'create-category'); createOpen = true"        
                    class="text-white font-semibold py-2 px-4 rounded transition bg-[#7a49f5] hover:bg-[#693de0]">
                Create Category
            </button>
        </div>
        
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Category 
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    {{ $category->aa_name }}
                                </td>
                                <td class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                    <div class="flex items-center justify-end" x-data="{ open: false }">
                                        <!-- Bouton 3 points -->
                                        <button @click="open = !open"
                                                class="inline-flex items-center p-1 text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4z M10 12a2 2 0 110-4 2 2 0 010 4z M10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                            </svg>
                                        </button>

                                        <!-- Dropdown -->
                                        <div x-show="open"
                                             @click.away="open = false"
                                             x-transition
                                             class="absolute mt-32 w-40 bg-white rounded-lg shadow-lg divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600 z-50">

                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <button @click="openEdit('{{ route('admin.categories.update', $category->aa_id) }}', '{{ addslashes($category->aa_name) }}'); open = false; $dispatch('open-modal', 'edit-category')"
                                                            class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        Edit
                                                    </button>
                                                </li>
                                            </ul>

                                            <div class="py-1">
                                                <button @click="openDelete('{{ route('admin.categories.destroy', $category->aa_id) }}'); open = false; $dispatch('open-modal', 'delete-category')"
                                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <x-modal name="create-category" :show="$errors->has('create_aa_name')" @close="createOpen = false">
        <div class="p-6">
            <h3 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mb-6">
                Create category
            </h3>
            
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category name</label>
                    <input type="text" name="aa_name" placeholder="Enter category name" required
                           class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    @error('create_aa_name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'create-category')"
                            class="w-full h-12 rounded-lg border border-[#7a49f5] text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="w-full h-12 rounded-lg bg-[#7a49f5] text-white font-semibold hover:bg-[#693de0] transition shadow-md">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Edit Modal -->
    <x-modal name="edit-category" :show="$errors->has('edit_aa_name')" @close="editOpen = false">
        <div class="p-6">
            <h3 class="text-2xl font-bold text-center text-gray-900 dark:text-gray-100 mb-6">
                Edit category
            </h3>
            
            <form method="POST" :action="editUrl">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category name</label>
                    <input type="text" name="aa_name" x-model="editName" placeholder="Enter category name" required
                           class="w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                     @error('edit_aa_name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-category')"
                            class="w-full h-12 rounded-lg border border-[#7a49f5] text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="w-full h-12 rounded-lg bg-[#7a49f5] text-white font-semibold hover:bg-[#693de0] transition shadow-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Delete Modal -->
    <x-modal name="delete-category" :show="false" @close="deleteOpen = false">
        <div class="p-6">
            <h3 class="text-xl font-bold text-center text-gray-900 dark:text-gray-100 mb-4">
                Delete Category
            </h3>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
                Are you sure you want to delete this category? 
            </p>

            <form method="POST" :action="deleteUrl">
                @csrf
                @method('DELETE')
                <div class="grid grid-cols-2 gap-4">
                     <button type="button" @click="$dispatch('close-modal', 'delete-category')"
                            class="w-full h-12 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="w-full h-12 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow-md">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

</div>
@endsection
