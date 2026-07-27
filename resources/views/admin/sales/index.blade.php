<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>


    <div class="py-6" x-data="salesApp()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-[#C4B5A5]/20 border border-[#8C7B6C]/40 text-[#4A2E2B] rounded-xl font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Relatório de Produtos Mais Vendidos & Estatísticas de Vendas -->
            @php
                $productCounts = [];
                $productTotals = [];
                foreach ($sales ?? [] as $s) {
                    $pName = $s['product_name'] ?? 'Outros';
                    $productCounts[$pName] = ($productCounts[$pName] ?? 0) + 1;
                    $productTotals[$pName] = ($productTotals[$pName] ?? 0) + ($s['amount_paid'] ?? 0);
                }
                arsort($productCounts);
                $topProducts = array_slice($productCounts, 0, 3, true);
            @endphp

            @if(count($sales ?? []) > 0)
                <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card Produto Mais Vendido -->
                    <div class="bg-[#FAF8F5] p-6 rounded-2xl border border-[#C4B5A5]/40 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C]">🏆 Campeão de Vendas</p>
                            <p class="text-xl font-bold text-[#2B2927] mt-1">{{ array_key_first($topProducts) ?? 'Nenhum' }}</p>
                            <p class="text-xs text-[#8C7B6C] mt-1">{{ current($topProducts) ?? 0 }} unidade(s) vendida(s)</p>
                        </div>
                        <div class="p-3.5 bg-[#F5F2EB] border border-[#C4B5A5]/30 rounded-2xl">
                            <svg class="w-6 h-6 text-[#4A2E2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                    </div>

                    <!-- Ranking Top 3 Peças -->
                    <div class="md:col-span-2 bg-[#FAF8F5] p-6 rounded-2xl border border-[#C4B5A5]/40 shadow-sm flex flex-col justify-center">
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#8C7B6C] mb-3">🔥 Ranking de Peças que Mais Saem</p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach($topProducts as $pName => $qty)
                                <div class="bg-[#F5F2EB] p-3 rounded-xl border border-[#C4B5A5]/30 flex items-center justify-between">
                                    <div class="truncate mr-2">
                                        <p class="text-xs font-bold text-[#2B2927] truncate">{{ $pName }}</p>
                                        <p class="text-[10px] text-[#8C7B6C]">R$ {{ number_format($productTotals[$pName] ?? 0, 2, ',', '.') }} total</p>
                                    </div>
                                    <span class="px-2 py-1 bg-[#4A2E2B] text-[#FAF8F5] font-bold text-xs rounded-full shrink-0">{{ $qty }}x</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Header da Seção -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-serif-logo text-3xl font-medium text-[#2B2927]">Histórico de Vendas</h3>
                <button @click="isCreateModalOpen = true" class="px-5 py-2.5 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-md hover:scale-105 transition-all duration-300 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#C4B5A5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nova Venda
                </button>
            </div>

            <!-- Tabela de Histórico de Vendas -->
            <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="border-b border-[#C4B5A5]/40 text-[#8C7B6C] text-xs uppercase tracking-wider font-semibold">
                                <th class="pb-4 px-4 font-semibold whitespace-nowrap">Data</th>
                                <th class="pb-4 px-4 font-semibold">Cliente</th>
                                <th class="pb-4 px-4 font-semibold">Contato</th>
                                <th class="pb-4 px-4 font-semibold">Peça</th>
                                <th class="pb-4 px-4 font-semibold text-right">Valor Pago</th>
                                <th class="pb-4 px-4 font-semibold text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#C4B5A5]/20 text-sm">
                            @forelse($sales ?? [] as $sale)
                                <tr class="hover:bg-[#F5F2EB]/60 transition-colors">
                                    <td class="py-4 px-4 text-[#8C7B6C] whitespace-nowrap font-light">
                                        @if(isset($sale['sale_date']))
                                            {{ date('d/m/Y', $sale['sale_date']) }}
                                        @elseif(isset($sale['created_at']))
                                            {{ date('d/m/Y', $sale['created_at']) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 font-semibold text-[#2B2927]">{{ $sale['client_name'] ?? 'N/A' }}</td>
                                    <td class="py-4 px-4 text-[#4A4643] font-light">{{ $sale['contact'] ?? '-' }}</td>
                                    <td class="py-4 px-4 text-[#2B2927] font-medium">{{ $sale['product_name'] ?? 'N/A' }}</td>
                                    <td class="py-4 px-4 text-[#4A2E2B] font-bold text-right whitespace-nowrap text-base">R$ {{ number_format($sale['amount_paid'] ?? 0, 2, ',', '.') }}</td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex justify-center gap-3">
                                            <!-- Botão Editar -->
                                            <button @click="openEditModal('{{ $sale['id'] }}', '{{ addslashes($sale['client_name'] ?? '') }}', '{{ addslashes($sale['contact'] ?? '') }}', '{{ addslashes($sale['product_name'] ?? '') }}', '{{ $sale['amount_paid'] ?? 0 }}')" class="text-[#8C7B6C] hover:text-[#4A2E2B] font-semibold text-xs uppercase tracking-wider transition-colors flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Editar
                                            </button>
                                            
                                            <!-- Botão Excluir -->
                                            <form action="{{ route('admin.sales.destroy', $sale['id']) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-700 hover:text-rose-900 font-semibold text-xs uppercase tracking-wider transition-colors flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-[#8C7B6C] font-light">
                                        Nenhuma venda registrada ainda. Clique no botão acima para cadastrar a primeira venda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- MODAL: NOVA VENDA -->
            <div x-show="isCreateModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                <!-- Fundo Escuro Semi-Transparente -->
                <div x-show="isCreateModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="isCreateModalOpen = false"></div>

                <!-- Conteúdo do Modal Nova Venda -->
                <div x-show="isCreateModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative z-[105] bg-[#FAF8F5] border border-[#C4B5A5]/40 rounded-3xl shadow-2xl max-w-2xl w-full overflow-hidden my-8">
                    <form action="{{ route('admin.sales.store') }}" method="POST">
                        @csrf
                        <div class="p-8">
                            <div class="flex justify-between items-center border-b border-[#C4B5A5]/30 pb-4 mb-6">
                                <h3 class="font-serif-logo text-3xl font-medium text-[#2B2927]" id="modal-title">Registrar Nova Venda</h3>
                                <button type="button" @click="isCreateModalOpen = false" class="text-[#8C7B6C] hover:text-[#2B2927] transition-colors p-1">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Nome do Cliente *</label>
                                    <input type="text" name="client_name" required class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm" placeholder="Ex: João Silva" value="{{ old('client_name') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Contato <span class="text-[10px] text-[#8C7B6C]/80 font-normal">(Opcional)</span></label>
                                    <input type="text" name="contact" class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm" placeholder="Ex: (11) 99999-9999" value="{{ old('contact') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Peça Vendida *</label>
                                    <div class="relative" x-data="{ selectedPriceMap: {{ json_encode(array_column($projects ?? [], 'price', 'title')) }} }">
                                        <input 
                                            type="text" 
                                            name="product_name" 
                                            list="registered-products-list"
                                            required 
                                            @change="if(selectedPriceMap[$el.value]) { const valInput = $el.closest('form').querySelector('input[name=amount_paid]'); if(valInput && !valInput.value) valInput.value = selectedPriceMap[$el.value]; }"
                                            class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm" 
                                            placeholder="Selecione ou digite o nome do produto..." 
                                            value="{{ old('product_name') }}"
                                        >
                                        <datalist id="registered-products-list">
                                            @foreach($projects ?? [] as $proj)
                                                @if(isset($proj['title']))
                                                    <option value="{{ $proj['title'] }}">{{ $proj['title'] }} - R$ {{ number_format($proj['price'] ?? 0, 2, ',', '.') }}</option>
                                                @endif
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Valor Pago (R$) *</label>
                                    <input type="number" step="0.01" name="amount_paid" required class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm" placeholder="Ex: 150.00" value="{{ old('amount_paid') }}">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Data da Venda <span class="text-[10px] text-[#8C7B6C]/80 font-normal">(Padrão: Hoje)</span></label>
                                    <input type="date" name="sale_date" value="{{ date('Y-m-d') }}" class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-[#F5F2EB] flex justify-end gap-3 rounded-b-3xl border-t border-[#C4B5A5]/30">
                            <button type="button" @click="isCreateModalOpen = false" class="px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-[#8C7B6C] hover:text-[#2B2927] transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-md transition-all">
                                Salvar Venda
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL: EDITAR VENDA -->
            <div x-show="isEditModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                <!-- Fundo Escuro Semi-Transparente -->
                <div x-show="isEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="isEditModalOpen = false"></div>

                <!-- Conteúdo do Modal Editar Venda -->
                <div x-show="isEditModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative z-[105] bg-[#FAF8F5] border border-[#C4B5A5]/40 rounded-3xl shadow-2xl max-w-2xl w-full overflow-hidden my-8">
                    <form :action="`/admin/sales/${editSaleId}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-8">
                            <div class="flex justify-between items-center border-b border-[#C4B5A5]/30 pb-4 mb-6">
                                <h3 class="font-serif-logo text-3xl font-medium text-[#2B2927]" id="modal-title">Editar Venda</h3>
                                <button type="button" @click="isEditModalOpen = false" class="text-[#8C7B6C] hover:text-[#2B2927] transition-colors p-1">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Nome do Cliente *</label>
                                    <input type="text" name="client_name" x-model="editClientName" required class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Contato <span class="text-[10px] text-[#8C7B6C]/80 font-normal">(Opcional)</span></label>
                                    <input type="text" name="contact" x-model="editContact" class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Peça Vendida *</label>
                                    <input 
                                        type="text" 
                                        name="product_name" 
                                        x-model="editProductName" 
                                        list="registered-products-list"
                                        required 
                                        class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm"
                                    >
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Valor Pago (R$) *</label>
                                    <input type="number" step="0.01" name="amount_paid" x-model="editAmountPaid" required class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] outline-none text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="px-8 py-4 bg-[#F5F2EB] flex justify-end gap-3 rounded-b-3xl border-t border-[#C4B5A5]/30">
                            <button type="button" @click="isEditModalOpen = false" class="px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-[#8C7B6C] hover:text-[#2B2927] transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-md transition-all">
                                Atualizar Venda
                            </button>
                        </div>
                    </form>
                </div>
            </div>           </div>

        </div>
    </div>

    <!-- Script de Lógica do Alpine -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('salesApp', () => ({
                isCreateModalOpen: false,
                isEditModalOpen: false,
                
                // Dados para o modal de edição
                editSaleId: null,
                editClientName: '',
                editContact: '',
                editProductName: '',
                editAmountPaid: '',

                openEditModal(id, client, contact, product, amount) {
                    this.editSaleId = id;
                    this.editClientName = client;
                    this.editContact = contact;
                    this.editProductName = product;
                    this.editAmountPaid = amount;
                    this.isEditModalOpen = true;
                }
            }))
        })
    </script>
</x-app-layout>
