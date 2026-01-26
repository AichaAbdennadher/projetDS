@extends('layouts.app')

@section('content')
    <div class="py-12" x-data="{ showModal: false, unregisterUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-bold text-3xl leading-tight mb-6 text-[#7a49f5]">
                        @if(Auth::user()->aa_role === 'admin')
                            List of Registrations
                        @else
                            My Registrations
                        @endif
                    </h2>

                    @if($registrations->isEmpty())
                        <p class="text-gray-500">No registrations found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Event title
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Start date
                                        </th>
                                        @if(Auth::user()->aa_role === 'admin')
                                         <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            User email
                                        </th>
                                        @endif
                                         @if(Auth::user()->aa_role === 'user')
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            End date
                                        </th>
                                      <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Place
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                            Action
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $reg)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-semib">
                                                    {{ $reg->event->aa_title }}
                                             
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                            
{{ $reg->event->aa_start_date->format('M d, Y , h:i A') }}
                                            </td>
                                            @if(Auth::user()->aa_role === 'admin')
                                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $reg->user->aa_email }}
                                                </td>
                                            @endif

                                            @if(Auth::user()->aa_role === 'user')
                                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $reg->event->aa_end_date->format('M d, Y , h:i A') }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    {{ $reg->event->aa_place }}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                                                    @if(now() < $reg->event->aa_start_date->subWeek())
                                                        <button type="button" 
                                                                @click="showModal = true; unregisterUrl = '{{ route('events.unregister', $reg->event->aa_id) }}'; $dispatch('open-modal', 'unregister-event')"
                                                                class="flex items-center justify-center gap-[5px] w-[83px] h-[40px] bg-[#7a49f5] rounded-[5px] text-white hover:bg-[#693de0] transition text-sm font-medium shadow-sm">
                                                            Cancel
                                                        </button>
                                                    @else
                                                        <button disabled 
                                                                class="flex items-center justify-center gap-[5px] w-[83px] h-[40px] bg-gray-200 text-gray-400 rounded-[5px] text-sm font-medium cursor-not-allowed">
                                                            Cancel
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $registrations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    <!-- Unregister Confirmation Modal -->
    <x-modal name="unregister-event" :show="false" @close="showModal = false">
        <div class="p-6 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Cancel Registration</h3>
            <p class="text-gray-500 text-sm mb-6">Are you sure you want to cancel your registration for this event?</p>
            
            <form :action="unregisterUrl" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex space-x-4 mt-6">
                    <button type="button" @click="$dispatch('close-modal', 'unregister-event')" class="flex-1 py-3 bg-white border-2 border-[#7a49f5] rounded-lg text-[#7a49f5] font-semibold hover:bg-purple-50 transition">
                        No, keep it
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-[#7a49f5] text-white rounded-lg font-bold hover:bg-[#693de0] transition shadow-md">
                        Yes, cancel
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
    </div>
@endsection
