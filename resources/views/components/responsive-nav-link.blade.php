@props(['active'])

@php
$classes = ($active ?? false)
? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#E60914] text-start text-base font-bold text-[#E60914] bg-[#E60914]/10 focus:outline-none focus:bg-[#E60914]/20 transition duration-300 ease-in-out'
: 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-white hover:bg-white/5 hover:border-[#E60914]/50 focus:outline-none focus:text-white focus:bg-white/5 focus:border-[#E60914]/50 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
