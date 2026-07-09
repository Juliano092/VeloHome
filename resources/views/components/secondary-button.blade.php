<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-2.5 bg-transparent border border-white/20 rounded-lg font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 disabled:opacity-25 transition-all']) }}>
    {{ $slot }}
</button>
