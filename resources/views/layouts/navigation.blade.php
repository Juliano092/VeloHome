<nav x-data="{ open: false }" class="bg-[#FAF8F5] border-r border-[#C4B5A5]/30 w-64 h-full flex flex-col shrink-0 transition-all duration-300 hidden sm:flex">
    <!-- Logo -->
    <div class="h-20 flex items-center px-6 border-b border-[#C4B5A5]/30 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex flex-col">
            <span class="font-serif-logo text-xl font-semibold tracking-wider text-[#2B2927] leading-none">valohome <span class="text-xs font-sans tracking-widest text-[#8C7B6C] font-normal uppercase">3D</span></span>
            <span class="text-[8px] tracking-[0.25em] text-[#8C7B6C] uppercase font-medium mt-1">Design & Value</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-[#2B2927] text-[#FAF8F5] shadow-sm' : 'text-[#4A4643] hover:bg-[#F5F2EB] hover:text-[#2B2927]' }}">
            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            {{ __('Painel') }}
        </a>

        <a href="{{ route('admin.sales.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.sales.*') ? 'bg-[#2B2927] text-[#FAF8F5] shadow-sm' : 'text-[#4A4643] hover:bg-[#F5F2EB] hover:text-[#2B2927]' }}">
            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ __('Vendas') }}
        </a>

        <a href="{{ route('admin.reports') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.reports') ? 'bg-[#2B2927] text-[#FAF8F5] shadow-sm' : 'text-[#4A4643] hover:bg-[#F5F2EB] hover:text-[#2B2927]' }}">
            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            {{ __('Relatórios de Peças') }}
        </a>

        <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.projects.*') ? 'bg-[#2B2927] text-[#FAF8F5] shadow-sm' : 'text-[#4A4643] hover:bg-[#F5F2EB] hover:text-[#2B2927]' }}">
            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            {{ __('Portfólio (Produtos)') }}
        </a>

        <a href="{{ route('admin.calculator') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.calculator') ? 'bg-[#2B2927] text-[#FAF8F5] shadow-sm' : 'text-[#4A4643] hover:bg-[#F5F2EB] hover:text-[#2B2927]' }}">
            <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            {{ __('Calculadora') }}
        </a>
    </div>

    <!-- User Profile & Logout -->
    <div class="border-t border-[#C4B5A5]/30 p-4 shrink-0">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center justify-between px-3 py-3 rounded-xl text-sm font-medium text-[#2B2927] bg-[#F5F2EB] hover:bg-[#C4B5A5]/20 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#2B2927] flex items-center justify-center text-[#F5F2EB] font-semibold text-xs">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="truncate max-w-[120px]">{{ Auth::user()->name }}</div>
                    </div>
                    <svg class="fill-current h-4 w-4 text-[#8C7B6C]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Sair') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>

<!-- Mobile Navigation Menu (Hamburger) -->
<div x-data="{ open: false }" class="sm:hidden fixed top-0 left-0 right-0 h-16 bg-[#FAF8F5] border-b border-[#C4B5A5]/30 z-50 flex items-center justify-between px-4">
    <a href="{{ route('dashboard') }}" class="flex flex-col">
        <span class="font-serif-logo text-lg font-semibold tracking-wider text-[#2B2927] leading-none">valohome <span class="text-xs font-sans tracking-widest text-[#8C7B6C] font-normal uppercase">3D</span></span>
    </a>
    
    <button @click="open = ! open" class="text-[#2B2927] hover:text-[#8C7B6C] p-2">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Mobile Dropdown Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden absolute top-16 left-0 right-0 bg-[#0B132B] border-b border-white/10 p-4 shadow-xl">
        <div class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-white rounded-lg {{ request()->routeIs('dashboard') ? 'bg-cyan-500/10 text-cyan-400' : 'hover:bg-white/5' }}">Painel</a>
            <a href="{{ route('admin.sales.index') }}" class="block px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.sales.*') ? 'bg-cyan-500/10 text-cyan-400' : 'hover:bg-white/5' }}">Vendas</a>
            <a href="{{ route('admin.projects.index') }}" class="block px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.projects.*') ? 'bg-cyan-500/10 text-cyan-400' : 'hover:bg-white/5' }}">Portfólio</a>
            <a href="{{ route('admin.calculator') }}" class="block px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.calculator') ? 'bg-cyan-500/10 text-cyan-400' : 'hover:bg-white/5' }}">Calculadora</a>
            <hr class="border-white/10 my-2">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white rounded-lg hover:bg-white/5">Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block px-4 py-3 text-white rounded-lg hover:bg-white/5">Sair</button>
            </form>
        </div>
    </div>
</div>
