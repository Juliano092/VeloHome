<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
                {{ __('Painel Geral') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sales.index') }}" class="px-5 py-2.5 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-sm transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nova Venda
                </a>
                <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 bg-[#FAF8F5] border border-[#C4B5A5] hover:bg-[#2B2927] hover:text-[#FAF8F5] text-[#2B2927] rounded-full font-medium text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                    + Novo Produto
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Total de Produtos -->
                <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between hover:shadow-md transition-all">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Total de Produtos 3D</p>
                        <p class="text-3xl font-bold text-[#2B2927] mt-2">{{ $totalProducts ?? 0 }}</p>
                        <span class="text-[11px] text-[#8C7B6C] mt-1 block">Peças cadastradas na loja</span>
                    </div>
                    <div class="p-4 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                        <svg class="w-7 h-7 text-[#4A2E2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Faturamento Total -->
                <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between hover:shadow-md transition-all">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Faturamento em Vendas</p>
                        <p class="text-3xl font-bold text-[#4A2E2B] mt-2">R$ {{ number_format($totalSalesAmount ?? 0, 2, ',', '.') }}</p>
                        <span class="text-[11px] text-[#8C7B6C] mt-1 block">{{ $totalSalesCount ?? 0 }} venda(s) realizada(s)</span>
                    </div>
                    <div class="p-4 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                        <svg class="w-7 h-7 text-[#4A2E2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Calculadora de Custos Shortcut -->
                <a href="{{ route('admin.calculator') }}" class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6 flex items-center justify-between hover:border-[#4A2E2B] hover:shadow-md transition-all group">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">Ferramenta Rápida</p>
                        <p class="text-2xl font-bold text-[#2B2927] mt-2 group-hover:text-[#4A2E2B] transition-colors">Calculadora 3D</p>
                        <span class="text-[11px] text-[#8C7B6C] mt-1 block">Calcular filamento, tempo e lucro</span>
                    </div>
                    <div class="p-4 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl group-hover:bg-[#4A2E2B] transition-all">
                        <svg class="w-7 h-7 text-[#4A2E2B] group-hover:text-[#FAF8F5] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </a>
            </div>

            <!-- Seção de Ações Rápidas & Últimas Vendas -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Tabela de Últimas Vendas (2/3) -->
                <div class="lg:col-span-2 bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="font-serif-logo text-2xl font-medium text-[#2B2927]">Últimas Vendas Registradas</h3>
                            <p class="text-xs text-[#8C7B6C]">Acompanhe os pedidos mais recentes da sua loja</p>
                        </div>
                        <a href="{{ route('admin.sales.index') }}" class="text-xs font-semibold uppercase tracking-wider text-[#4A2E2B] hover:underline">Ver Todas &rarr;</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[#C4B5A5]/30 text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">
                                    <th class="pb-3">Cliente</th>
                                    <th class="pb-3">Peça Vendida</th>
                                    <th class="pb-3 text-right">Valor Pago</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C4B5A5]/20 text-sm">
                                @forelse($recentSales ?? [] as $sale)
                                    <tr>
                                        <td class="py-3.5 font-medium text-[#2B2927]">
                                            {{ $sale['client_name'] ?? 'Cliente' }}
                                            @if(!empty($sale['contact']))
                                                <span class="block text-[11px] text-[#8C7B6C] font-normal">{{ $sale['contact'] }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 text-[#4A4643]">{{ $sale['product_name'] ?? '-' }}</td>
                                        <td class="py-3.5 text-right font-bold text-[#4A2E2B]">
                                            R$ {{ number_format($sale['amount_paid'] ?? 0, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-[#8C7B6C] font-light text-xs">
                                            Nenhuma venda registrada ainda. Clique em "+ Nova Venda" para começar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Painel de Atalhos & Suporte (1/3) -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40 p-6">
                        <h3 class="font-serif-logo text-2xl font-medium text-[#2B2927] mb-3">Acesso Rápido ao Site</h3>
                        <p class="text-xs text-[#4A4643] font-light leading-relaxed mb-6">
                            Veja exatamente como os seus clientes enxergam seu catálogo em tempo real.
                        </p>
                        
                        <a href="{{ url('/') }}" target="_blank" class="w-full py-3 px-4 bg-[#2B2927] hover:bg-[#8C7B6C] text-[#FAF8F5] rounded-xl font-medium text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Abrir Catálogo Público
                        </a>
                    </div>

                    <!-- Dica ValoHome -->
                    <div class="bg-[#F5F2EB] overflow-hidden sm:rounded-2xl border border-[#C4B5A5]/40 p-6">
                        <div class="flex items-center gap-2 text-[#4A2E2B] font-semibold text-xs uppercase tracking-wider mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Dica ValoHome
                        </div>
                        <p class="text-xs text-[#4A4643] font-light leading-relaxed">
                            Mantenha seus produtos atualizados com fotos em alta resolução para aumentar os pedidos no WhatsApp!
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
