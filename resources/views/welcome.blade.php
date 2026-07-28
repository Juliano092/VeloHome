@extends('layouts.public')

@section('content')
    <div x-data="{
        isImageModalOpen: false,
        selectedProject: null,
        searchQuery: '',
        selectedCategory: 'Todos',
        whatsappNumber: '5500000000000',
        matchesFilter(title, category) {
            const matchesCat = this.selectedCategory === 'Todos' || category === this.selectedCategory;
            const matchesSearch = !this.searchQuery || title.toLowerCase().includes(this.searchQuery.toLowerCase()) || category.toLowerCase().includes(this.searchQuery.toLowerCase());
            return matchesCat && matchesSearch;
        }
    }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Hero Header da Loja -->
        <div class="text-center py-12 sm:py-16 relative">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('imagem/valohome_logo.png') }}?v=3" alt="ValoHome 3D Logo" class="h-20 sm:h-24 w-auto object-contain mix-blend-multiply">
            </div>

            <p class="text-xs sm:text-sm tracking-[0.3em] uppercase text-[#8C7B6C] font-semibold mb-2">ValoHome Store</p>

            <h1 class="font-serif-logo text-5xl sm:text-7xl font-normal tracking-wide text-[#2B2927] mb-4">
                Coleção & <span class="italic text-[#8C7B6C]">Catálogo 3D</span>
            </h1>
            <p class="mt-2 text-base sm:text-lg text-[#4A4643] max-w-2xl mx-auto font-light leading-relaxed">
                Navegue por nossas peças exclusivas de decoração e projetos 3D. Selecione seu item favorito e faça seu
                pedido diretamente via WhatsApp.
            </p>
        </div>

        <!-- Barra da Loja: Busca e Filtros por Categoria -->
        <div class="mb-12 bg-[#FAF8F5] p-6 rounded-2xl border border-[#C4B5A5]/40 shadow-sm space-y-6">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">

                <!-- Campo de Busca de Produtos -->
                <div class="relative w-full md:w-80">
                    <input type="text" x-model="searchQuery" placeholder="Buscar peça ou categoria..."
                        class="w-full pl-10 pr-4 py-2.5 bg-[#F5F2EB] border border-[#C4B5A5]/40 rounded-full text-sm text-[#2B2927] placeholder-[#8C7B6C] focus:outline-none focus:border-[#2B2927] transition-all">
                    <svg class="w-4 h-4 text-[#8C7B6C] absolute left-3.5 top-3.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Contador de itens -->
                <div class="text-xs tracking-wider uppercase text-[#8C7B6C] font-medium hidden md:block">
                    Exibindo produtos exclusivos
                </div>
            </div>

            <!-- Pills de Filtro por Categoria -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                <button @click="selectedCategory = 'Todos'"
                    :class="selectedCategory === 'Todos' ? 'bg-[#2B2927] text-[#FAF8F5]' :
                        'bg-[#F5F2EB] text-[#4A4643] hover:bg-[#C4B5A5]/30'"
                    class="px-5 py-2 rounded-full text-xs font-semibold tracking-wider uppercase transition-all shrink-0">
                    Todos os Produtos
                </button>
                @php
                    $categories = array_values(array_unique(array_filter(array_column($projects, 'category'))));
                @endphp
                @foreach ($categories as $cat)
                    <button @click="selectedCategory = '{{ $cat }}'"
                        :class="selectedCategory === '{{ $cat }}' ? 'bg-[#2B2927] text-[#FAF8F5]' :
                            'bg-[#F5F2EB] text-[#4A4643] hover:bg-[#C4B5A5]/30'"
                        class="px-5 py-2 rounded-full text-xs font-semibold tracking-wider uppercase transition-all shrink-0">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Vitrine de Produtos (Loja E-commerce) -->
        <div id="galeria" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($projects as $project)
                @php
                    $title = $project['title'] ?? 'Peça 3D';
                    $category = $project['category'] ?? 'Decoração';
                    $price = number_format($project['price'] ?? 0, 2, ',', '.');
                    $img = $project['image_url'] ?? null;
                    $desc =
                        $project['description'] ?? 'Peça impressa em alta resolução com acabamento artesanal ValoHome.';
                @endphp
                <!-- Card de Produto estilo Boutique -->
                <div x-show="matchesFilter('{{ addslashes($title) }}', '{{ addslashes($category) }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-[#FAF8F5] rounded-2xl overflow-hidden hover:-translate-y-1.5 transition-all duration-300 group border border-[#C4B5A5]/40 shadow-sm hover:shadow-xl flex flex-col h-full relative">
                    <!-- Selo de Exclusivo / Categoria -->
                    <div class="absolute top-4 left-4 z-20">
                        <span
                            class="px-3 py-1 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full text-[10px] tracking-widest uppercase font-semibold text-[#2B2927] border border-[#C4B5A5]/30 shadow-sm">
                            {{ $category }}
                        </span>
                    </div>

                    <!-- Foto do Produto -->
                    <div class="aspect-w-16 aspect-h-12 bg-[#F5F2EB] flex items-center justify-center relative overflow-hidden shrink-0 h-64 border-b border-[#C4B5A5]/20 cursor-pointer"
                        @click="selectedProject = { title: '{{ addslashes($title) }}', category: '{{ addslashes($category) }}', price: '{{ $price }}', image: '{{ $img }}', description: '{{ addslashes($desc) }}' }; isImageModalOpen = true">
                        @if ($img)
                            <img src="{{ $img }}" alt="{{ $title }}"
                                class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                            <!-- Quick View Overlay -->
                            <div
                                class="absolute inset-0 bg-[#2B2927]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                                <span
                                    class="px-4 py-2 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full text-[#2B2927] text-xs font-semibold uppercase tracking-wider shadow-md">
                                    Espiar Detalhes
                                </span>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#8C7B6C] font-light text-sm">
                                Sem Foto</div>
                        @endif
                    </div>

                    <!-- Informações e Botão de Compra -->
                    <div class="p-6 flex flex-col flex-1">
                        <h3
                            class="font-serif-logo text-2xl font-medium text-[#2B2927] mb-2 leading-tight group-hover:text-[#8C7B6C] transition-colors">
                            {{ $title }}
                        </h3>

                        <p class="text-xs text-[#4A4643] line-clamp-2 mb-6 font-light">
                            {{ $desc }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-[#C4B5A5]/30 flex items-center justify-between gap-2">
                            <div>
                                <span
                                    class="text-[10px] text-[#8C7B6C] uppercase font-semibold block tracking-wider">Preço</span>
                                <span class="text-xl font-semibold text-[#2B2927]">
                                    R$ {{ $price }}
                                </span>
                            </div>

                            <!-- Botão Encomendar / WhatsApp -->
                            <a href="https://wa.me/{{ config('app.whatsapp_number', '5500000000000') }}?text={{ urlencode('Olá ValoHome 3D! Gostaria de encomendar a peça: ' . $title) }}"
                                target="_blank"
                                class="px-4 py-2.5 rounded-full bg-[#2B2927] hover:bg-[#8C7B6C] text-[#FAF8F5] text-xs font-medium uppercase tracking-wider transition-all duration-300 flex items-center gap-1.5 shadow-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.147 4.192 4.29-1.125z" />
                                </svg>
                                Encomendar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-[#FAF8F5] rounded-2xl border border-[#C4B5A5]/30">
                    <p class="text-[#8C7B6C] font-serif-logo text-2xl mb-1">Catálogo em atualização</p>
                    <p class="text-[#4A4643] text-sm">Os produtos adicionados aparecerão aqui em breve.</p>
                </div>
            @endforelse

        </div>

        <!-- MODAL QUICK-VIEW DO PRODUTO LOJA -->
        <div x-show="isImageModalOpen" style="display: none;"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto p-4">
            <!-- Fundo Escuro com desfoque -->
            <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-[#2B2927]/80 backdrop-blur-md" @click="isImageModalOpen = false"></div>

            <!-- Modal Card do Produto -->
            <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative z-[105] bg-[#FAF8F5] border border-[#C4B5A5]/40 rounded-3xl shadow-2xl max-w-3xl w-full overflow-hidden my-8">

                <!-- Botão Fechar -->
                <button @click="isImageModalOpen = false"
                    class="absolute top-4 right-4 text-[#2B2927] hover:text-[#8C7B6C] bg-[#F5F2EB] p-2 rounded-full z-20 border border-[#C4B5A5]/30">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <template x-if="selectedProject">
                    <div class="grid md:grid-cols-2">
                        <!-- Foto em Destaque no Modal -->
                        <div
                            class="bg-[#F5F2EB] flex items-center justify-center p-6 border-b md:border-b-0 md:border-r border-[#C4B5A5]/30 min-h-[300px]">
                            <img :src="selectedProject.image" :alt="selectedProject.title"
                                class="max-h-[350px] w-full object-contain rounded-xl shadow-md">
                        </div>

                        <!-- Detalhes do Produto no Modal -->
                        <div class="p-8 flex flex-col justify-between">
                            <div>
                                <span
                                    class="px-3 py-1 bg-[#F5F2EB] rounded-full text-[10px] tracking-widest uppercase font-semibold text-[#8C7B6C] border border-[#C4B5A5]/30"
                                    x-text="selectedProject.category"></span>
                                <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] mt-3 mb-2"
                                    x-text="selectedProject.title"></h2>
                                <p class="text-xs text-[#8C7B6C] tracking-wider uppercase font-semibold mb-4">Garantia de
                                    Qualidade ValoHome 3D</p>
                                <p class="text-sm text-[#4A4643] leading-relaxed mb-6 font-light"
                                    x-text="selectedProject.description"></p>
                            </div>

                            <div class="pt-6 border-t border-[#C4B5A5]/30">
                                <div class="mb-4">
                                    <span class="text-xs text-[#8C7B6C] uppercase font-semibold block">Valor sob consulta /
                                        pronta entrega</span>
                                    <span class="text-3xl font-semibold text-[#2B2927]">R$ <span
                                            x-text="selectedProject.price"></span></span>
                                </div>

                                <a :href="'https://wa.me/' + whatsappNumber + '?text=' + encodeURIComponent('Olá ValoHome 3 D!
                                    Gostaria de tirar dúvidas / encomendar a peça: ' + selectedProject.title)"
                                    target="_blank"
                                    class="w-full py-3.5 rounded-full bg-[#2B2927] hover:bg-[#8C7B6C] text-[#FAF8F5] text-xs font-semibold uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.147 4.192 4.29-1.125z" />
                                    </svg>
                                    Comprar pelo WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>
@endsection
