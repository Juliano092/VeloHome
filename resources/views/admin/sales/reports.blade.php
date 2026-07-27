<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
            {{ __('Relatório de Saídas de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
        startDate: '', 
        endDate: '',
        searchQuery: '',
        hasSearched: false,
        
        doSearch() {
            this.hasSearched = true;
        },
        
        resetSearch() {
            this.startDate = '';
            this.endDate = '';
            this.searchQuery = '';
            this.hasSearched = false;
        },

        matchesDate(dateTimestamp) {
            if (!dateTimestamp) return true;
            const itemDate = new Date(dateTimestamp * 1000).toISOString().split('T')[0];
            if (this.startDate && itemDate < this.startDate) return false;
            if (this.endDate && itemDate > this.endDate) return false;
            return true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form de Consulta com Botão Gerar Relatório -->
            <div class="bg-[#FAF8F5] p-6 rounded-2xl border border-[#C4B5A5]/40 shadow-sm space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-serif-logo text-2xl font-medium text-[#2B2927]">Consultar Relatório de Vendas</h3>
                        <p class="text-xs text-[#8C7B6C]">Selecione o período desejado (Data Inicial e Data Final) e clique em **Gerar Relatório** para carregar os dados.</p>
                    </div>

                    <button 
                        x-show="hasSearched"
                        @click="resetSearch()" 
                        class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C] hover:text-[#4A2E2B] transition-colors self-start lg:self-center"
                    >
                        Limpar Consulta
                    </button>
                </div>

                <!-- Formulário com 2 Campos de Data + Busca + Botão Consultar -->
                <form @submit.prevent="doSearch()" class="grid grid-cols-1 sm:grid-cols-4 gap-4 pt-2 border-t border-[#C4B5A5]/30 items-end">
                    <!-- Campo 1: Data Inicial -->
                    <div>
                        <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Data Inicial</label>
                        <input 
                            type="date" 
                            x-model="startDate" 
                            class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2.5 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm"
                        >
                    </div>

                    <!-- Campo 2: Data Final -->
                    <div>
                        <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Data Final</label>
                        <input 
                            type="date" 
                            x-model="endDate" 
                            class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2.5 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm"
                        >
                    </div>

                    <!-- Campo 3: Buscar Produto/Cliente -->
                    <div>
                        <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Peça / Cliente (Opcional)</label>
                        <input 
                            type="text" 
                            x-model="searchQuery" 
                            placeholder="Ex: Vaso, João..." 
                            class="w-full px-4 py-2.5 bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl text-sm text-[#2B2927] placeholder-[#8C7B6C] focus:outline-none focus:border-[#2B2927] transition-all"
                        >
                    </div>

                    <!-- Botão de Ação: Gerar Relatório -->
                    <div>
                        <button 
                            type="submit"
                            class="w-full py-2.5 px-6 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] font-semibold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all flex items-center justify-center gap-2"
                        >
                            <svg class="w-4 h-4 text-[#C4B5A5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Gerar Relatório
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabela Principal de Resultados (só exibe após clicar em Gerar Relatório) -->
            <div x-show="hasSearched" x-transition:enter="transition ease-out duration-300" class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="border-b border-[#C4B5A5]/40 text-[#8C7B6C] text-xs uppercase tracking-wider font-semibold">
                                <th class="pb-4 px-4 font-semibold whitespace-nowrap">Data da Venda</th>
                                <th class="pb-4 px-4 font-semibold">Peça Vendida (Produto)</th>
                                <th class="pb-4 px-4 font-semibold">Cliente</th>
                                <th class="pb-4 px-4 font-semibold">Contato</th>
                                <th class="pb-4 px-4 font-semibold text-right">Valor Arrecadado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#C4B5A5]/20 text-sm">
                            @forelse($sales ?? [] as $sale)
                                @php
                                    $rawDate = $sale['sale_date'] ?? ($sale['created_at'] ?? time());
                                    $pName = $sale['product_name'] ?? 'N/A';
                                    $cName = $sale['client_name'] ?? 'N/A';
                                @endphp
                                <tr 
                                    x-show="matchesDate({{ $rawDate }}) && (!searchQuery || '{{ addslashes(strtolower($pName)) }}'.includes(searchQuery.toLowerCase()) || '{{ addslashes(strtolower($cName)) }}'.includes(searchQuery.toLowerCase()))"
                                    class="hover:bg-[#F5F2EB]/60 transition-colors"
                                >
                                    <td class="py-4 px-4 text-[#8C7B6C] whitespace-nowrap font-medium">
                                        {{ date('d/m/Y', $rawDate) }}
                                    </td>
                                    <td class="py-4 px-4 font-bold text-[#2B2927]">
                                        <span class="inline-block px-3 py-1 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-lg text-xs font-semibold text-[#2B2927]">
                                            {{ $pName }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 font-semibold text-[#2B2927]">{{ $cName }}</td>
                                    <td class="py-4 px-4 text-[#4A4643] font-light">{{ $sale['contact'] ?? '-' }}</td>
                                    <td class="py-4 px-4 text-[#4A2E2B] font-bold text-right whitespace-nowrap text-base">
                                        R$ {{ number_format($sale['amount_paid'] ?? 0, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[#8C7B6C] font-light">
                                        Nenhuma venda encontrada para o período selecionado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Estado Inicial: Antes de clicar em Gerar Relatório -->
            <div x-show="!hasSearched" class="bg-[#FAF8F5] p-12 rounded-2xl border border-[#C4B5A5]/40 text-center shadow-sm">
                <div class="w-14 h-14 bg-[#F5F2EB] border border-[#C4B5A5]/40 rounded-full flex items-center justify-center mx-auto mb-4 text-[#4A2E2B]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="font-serif-logo text-3xl font-medium text-[#2B2927] mb-2">Aguardando Consulta</h4>
                <p class="text-sm text-[#8C7B6C] max-w-md mx-auto font-light leading-relaxed">
                    Informe as datas de início e término nos campos acima e clique no botão <strong class="font-semibold text-[#2B2927]">"Gerar Relatório"</strong> para visualizar os resultados.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
