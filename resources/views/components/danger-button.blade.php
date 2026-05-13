<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#E60914] border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-[#b80710] active:bg-[#96050c] focus:outline-none focus:ring-2 focus:ring-[#E60914] focus:ring-offset-2 focus:ring-offset-gray-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
