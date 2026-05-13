<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border border-[#E60914] rounded-lg font-bold text-sm text-[#E60914] uppercase tracking-widest hover:bg-[#E60914]/10 focus:outline-none focus:ring-2 focus:ring-[#E60914] disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
