@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-gray-50 border border-gray-300 rounded-lg h-12 px-4 focus:ring-2 focus:ring-[#7a49f5] focus:border-transparent transition']) !!}>
