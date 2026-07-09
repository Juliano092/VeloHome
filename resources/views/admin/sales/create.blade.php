<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.sales.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Calculadora de Orçamentos / Nova Venda') }}
            </h2>
        </div>
    </x-slot>

    <!-- Alpine.js via CDN para reatividade do cálculo -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <div class="py-12" x-data="calculator()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.sales.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                
                <!-- Coluna Esquerda: Formulário de Entrada (2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    @if(session('success'))
                        <div class="px-4 py-3 bg-green-500/20 border border-green-500/30 text-green-300 rounded-lg backdrop-blur-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- 0. Dados da Venda -->
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 border-l-4 border-l-yellow-500">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Dados da Venda
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Nome do Cliente</label>
                                <input type="text" name="client_name" required class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-yellow-500 focus:border-yellow-500 outline-none" placeholder="Ex: João Silva" value="{{ old('client_name') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Peça Vendida</label>
                                <input type="text" name="product_name" required class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-yellow-500 focus:border-yellow-500 outline-none" placeholder="Ex: Vaso Decorativo" value="{{ old('product_name') }}">
                            </div>
                        </div>
                    </div>

                    <!-- 1. Dados do Material e Consumo -->
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 border-l-4 border-l-cyan-500">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            1. Material e Consumo
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Peso da Peça <span class="text-xs text-gray-500">(Fatiador)</span></label>
                                <div class="flex gap-2">
                                    <input type="number" x-model.number="peso_da_peca" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-cyan-500 focus:border-cyan-500 outline-none" placeholder="Ex: 150">
                                    <select x-model="unidade_peso" class="w-24 bg-[#0B132B] border border-white/10 rounded-lg px-2 py-2 text-white focus:ring-cyan-500 focus:border-cyan-500 outline-none">
                                        <option value="g">g</option>
                                        <option value="kg">kg</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Preço do Filamento (R$/kg)</label>
                                <input type="number" step="0.01" x-model.number="preco_do_filamento" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-cyan-500 focus:border-cyan-500 outline-none" placeholder="Ex: 120.00">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-400 mb-1">Tipo de Material (Opcional)</label>
                                <select class="w-full bg-[#0B132B] border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-cyan-500 focus:border-cyan-500 outline-none">
                                    <option>PLA</option>
                                    <option>PETG</option>
                                    <option>ABS</option>
                                    <option>TPU</option>
                                    <option>Resina Padrão</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Tempo e Desgaste da Máquina -->
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 border-l-4 border-l-blue-500">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            2. Tempo e Máquina
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Tempo de Impressão</label>
                                <div class="flex gap-2">
                                    <input type="number" step="0.1" x-model.number="tempo_de_impressao" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Ex: 5.5">
                                    <select x-model="unidade_tempo" class="w-28 bg-[#0B132B] border border-white/10 rounded-lg px-2 py-2 text-white focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        <option value="horas">Horas</option>
                                        <option value="minutos">Minutos</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Custo Hora/Máquina (R$)</label>
                                <input type="number" step="0.01" x-model.number="custo_hora_maquina" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-blue-500 focus:border-blue-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Mão de Obra -->
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 border-l-4 border-l-purple-500">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            3. Mão de Obra e Setup
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Preparação (min)</label>
                                <input type="number" x-model.number="tempo_de_preparacao" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-purple-500 focus:border-purple-500 outline-none" placeholder="Ex: 15">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Pós-Process. (min)</label>
                                <input type="number" x-model.number="tempo_de_pos_processamento" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-purple-500 focus:border-purple-500 outline-none" placeholder="Ex: 30">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Sua Hora Trab. (R$)</label>
                                <input type="number" step="0.01" x-model.number="valor_da_hora_trabalho" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-purple-500 focus:border-purple-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- 4. Margens (Ocultos/Fixos) -->
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 border-l-4 border-l-green-500">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            4. Custos Fixos e Lucro
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Taxa de Falha (%)</label>
                                <div class="relative">
                                    <input type="number" step="1" x-model.number="taxa_de_falha" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-green-500 focus:border-green-500 outline-none pr-8">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">%</div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Margem de Lucro (%)</label>
                                <div class="relative">
                                    <input type="number" step="1" x-model.number="margem_de_lucro" class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:ring-green-500 focus:border-green-500 outline-none pr-8">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Coluna Direita: Resultados (1/3) -->
                <div class="lg:col-span-1">
                    <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-white mb-6 border-b border-white/10 pb-4 text-center">Resumo do Orçamento</h3>
                        
                        <div class="space-y-4">
                            <!-- Detalhamento -->
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Custo Material:</span>
                                <span class="text-cyan-300 font-medium" x-text="formatMoney(custoMaterial())"></span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Custo Máquina:</span>
                                <span class="text-blue-300 font-medium" x-text="formatMoney(custoMaquina())"></span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">Mão de Obra:</span>
                                <span class="text-purple-300 font-medium" x-text="formatMoney(custoMaoDeObra())"></span>
                            </div>
                            
                            <div class="border-t border-white/10 pt-4 mt-2">
                                <div class="flex justify-between items-center text-sm mb-1">
                                    <span class="text-gray-300 font-medium">Custo Produção:</span>
                                    <span class="text-white font-semibold" x-text="formatMoney(custoProducao())"></span>
                                </div>
                                <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                    <span>(Incluindo taxa de falha de <span x-text="taxa_de_falha"></span>%)</span>
                                </div>
                            </div>

                            <!-- Lucro -->
                            <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-green-400 font-bold text-sm">Lucro Bruto:</span>
                                    <span class="text-green-400 font-bold" x-text="formatMoney(lucroReal())"></span>
                                </div>
                            </div>

                            <!-- Preço Final -->
                            <div class="mt-6 text-center">
                                <span class="block text-gray-400 text-sm font-medium mb-1">Preço de Venda Sugerido</span>
                                <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-green-400 drop-shadow-lg" x-text="formatMoney(precoFinal())">
                                    R$ 0,00
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-white/10">
                            <input type="hidden" name="cost" :value="custoProducao()">
                            <input type="hidden" name="price" :value="precoFinal()">
                            <input type="hidden" name="profit" :value="lucroReal()">
                            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl font-bold shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] transition-all">
                                Salvar Venda
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Script de Lógica do Alpine -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('calculator', () => ({
                // 1. Material
                peso_da_peca: 0,
                unidade_peso: 'g',
                preco_do_filamento: 120, // Padrão
                // 2. Máquina
                tempo_de_impressao: 0,
                unidade_tempo: 'horas',
                custo_hora_maquina: 2.50, // Padrão 
                // 3. Mão de Obra
                tempo_de_preparacao: 0,
                tempo_de_pos_processamento: 0,
                valor_da_hora_trabalho: 35.00, // Padrão
                // 4. Margens
                taxa_de_falha: 10, // 10%
                margem_de_lucro: 50, // 50%

                // Cálculos
                custoMaterial() {
                    let pesoGrama = this.unidade_peso === 'kg' ? ((this.peso_da_peca || 0) * 1000) : (this.peso_da_peca || 0);
                    return (this.preco_do_filamento / 1000) * pesoGrama;
                },
                custoMaquina() {
                    let tempoHoras = this.unidade_tempo === 'minutos' ? ((this.tempo_de_impressao || 0) / 60) : (this.tempo_de_impressao || 0);
                    return tempoHoras * (this.custo_hora_maquina || 0);
                },
                custoMaoDeObra() {
                    let totalMinutos = (this.tempo_de_preparacao || 0) + (this.tempo_de_pos_processamento || 0);
                    return (totalMinutos / 60) * (this.valor_da_hora_trabalho || 0);
                },
                custoProducao() {
                    let somaCustos = this.custoMaterial() + this.custoMaquina() + this.custoMaoDeObra();
                    let margemFalha = 1 + ((this.taxa_de_falha || 0) / 100);
                    return somaCustos * margemFalha;
                },
                precoFinal() {
                    let margemLucro = 1 + ((this.margem_de_lucro || 0) / 100);
                    return this.custoProducao() * margemLucro;
                },
                lucroReal() {
                    return this.precoFinal() - this.custoProducao();
                },

                // Formatação de Moeda BRL
                formatMoney(value) {
                    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value || 0);
                }
            }))
        })
    </script>
</x-app-layout>
