@extends('layouts.app')
@section('content')
    <div class="py-12" x-data="{ 
        deleteOpen: false, 
        deleteUrl: '', 
        openDelete(url) { 
            this.deleteUrl = url; 
            this.deleteOpen = true; 
        } 
    }">
        <div class="max-w-7xl mx-auto sm:px-5 lg:px-3">
 <h2 class="font-bold text-3xl leading-tight mb-6 text-[#7a49f5]">
    List of Events
</h2>

          <div class="mb-4 flex justify-end">
    <a href="{{ route('admin.events.create') }}"
       class="text-white font-semibold py-2 px-4 rounded transition"
       style="background-color:#7a49f5;"
       onmouseover="this.style.backgroundColor='#693de0'"
       onmouseout="this.style.backgroundColor='#7a49f5'">
        Create Event
    </a>
</div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Event Name
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                       Start Date
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                       End Date
                                    </th>
                                      <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Pricing
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                       Capacity
                                    </th>   
                                  
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                        Place
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            <div class="flex items-center">
                                            
                                                <div class="ml-3">
                                                    <p class="text-gray-900 dark:text-gray-100 whitespace-no-wrap">
                                                        {{ $event->aa_title }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            {{ $event->aa_start_date->format('M d, Y H:i') }}
                                        </td>
                                          <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            {{ $event->aa_end_date->format('M d, Y H:i') }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            {{ $event->aa_price }}$
                                        </td>
                                         <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                          {{ $event->aa_capacity }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            {{ $event->aa_place }}
                                        </td>
                                      
                                       <td class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
    <div class="flex items-center justify-end" x-data="{ open: false }">
        
        <!-- Bouton 3 points -->
        <button @click="open = !open"
                class="inline-flex items-center p-1 text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 6a2 2 0 110-4 2 2 0 010 4z
                 M10 12a2 2 0 110-4 2 2 0 010 4z
                 M10 18a2 2 0 110-4 2 2 0 010 4z"/>
    </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open"
             @click.away="open = false"
             x-transition
             class="absolute mt-32 w-40 bg-white rounded-lg shadow-lg divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600 z-50">

            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <a href="{{ route('admin.events.edit', $event->aa_id) }}"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Edit
                    </a>
                </li>
            </ul>

            <div class="py-1">
                <button @click="openDelete('{{ route('admin.events.destroy', $event->aa_id) }}'); open = false; $dispatch('open-modal', 'delete-event')"
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
                 
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <x-modal name="delete-event" :show="false" @close="deleteOpen = false">
            <div class="p-6">
                <h3 class="text-xl font-bold text-center text-gray-900 dark:text-gray-100 mb-4">
                    Delete Event
                </h3>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
                    Are you sure you want to delete this event? 
                </p>

                <form method="POST" :action="deleteUrl">
                    @csrf
                    @method('DELETE')
                    <div class="grid grid-cols-2 gap-4">
                         <button type="button" @click="$dispatch('close-modal', 'delete-event')"
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
