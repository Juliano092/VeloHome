<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
            {{ __('Painel Inicial') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card Projetos -->
                <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Total de Produtos 3D</p>
                        <p class="text-3xl font-bold text-[#2B2927] mt-2">--</p>
                    </div>
                    <div class="p-3.5 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                        <svg class="w-7 h-7 text-[#2B2927]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card Vendas -->
                <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Vendas (Mês)</p>
                        <p class="text-3xl font-bold text-[#2B2927] mt-2">R$ 0,00</p>
                    </div>
                    <div class="p-3.5 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                        <svg class="w-7 h-7 text-[#8C7B6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card Visitas -->
                <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Visualizações</p>
                        <p class="text-3xl font-bold text-[#2B2927] mt-2">0</p>
                    </div>
                    <div class="p-3.5 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                        <svg class="w-7 h-7 text-[#2B2927]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Boas-vindas -->
            <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-8">
                <h3 class="font-serif-logo text-3xl font-medium text-[#2B2927] mb-2">Bem-vindo ao ValoHome 3D Painel</h3>
                <p class="text-[#4A4643] font-light leading-relaxed text-sm">Você está conectado como Administrador. Utilize o menu lateral para gerenciar suas Vendas, Portfólio de Produtos e Calculadora de Custos 3D.</p>
            </div>
        </div>
    </div>
</x-app-layout>
