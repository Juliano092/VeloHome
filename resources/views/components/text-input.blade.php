@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-cyan-500 focus:border-cyan-500 outline-none']) }}>
