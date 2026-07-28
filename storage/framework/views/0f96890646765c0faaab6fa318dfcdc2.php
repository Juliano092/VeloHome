<?php $__env->startSection('content'); ?>
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
                <img src="<?php echo e(asset('imagem/valohome_logo.png')); ?>?v=3" alt="ValoHome 3D Logo" class="h-20 sm:h-24 w-auto object-contain mix-blend-multiply">
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
                <?php
                    $categories = array_values(array_unique(array_filter(array_column($projects, 'category'))));
                ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button @click="selectedCategory = '<?php echo e($cat); ?>'"
                        :class="selectedCategory === '<?php echo e($cat); ?>' ? 'bg-[#2B2927] text-[#FAF8F5]' :
                            'bg-[#F5F2EB] text-[#4A4643] hover:bg-[#C4B5A5]/30'"
                        class="px-5 py-2 rounded-full text-xs font-semibold tracking-wider uppercase transition-all shrink-0">
                        <?php echo e($cat); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div id="galeria" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $title = $project['title'] ?? 'Peça 3D';
                    $category = $project['category'] ?? 'Decoração';
                    $price = number_format($project['price'] ?? 0, 2, ',', '.');
                    
                    // Função utilitária para converter qualquer URL de storage em caminho relativo absoluto (/storage/...)
                    $fixStorageUrl = function($url) {
                        if (!$url) return null;
                        if (str_contains($url, '/storage/')) {
                            return '/storage/' . explode('/storage/', $url)[1];
                        }
                        return $url;
                    };

                    $img = $fixStorageUrl($project['image_url'] ?? null);
                    $rawImages = $project['images'] ?? ($img ? [$img] : []);
                    if (empty($rawImages) && $img) {
                        $rawImages = [$img];
                    }
                    $images = array_values(array_filter(array_map($fixStorageUrl, $rawImages)));
                    $desc = $project['description'] ?? 'Peça impressa em alta resolução com acabamento artesanal ValoHome.';
                ?>
                <!-- Card de Produto estilo Boutique -->
                <div x-show="matchesFilter('<?php echo e(addslashes($title)); ?>', '<?php echo e(addslashes($category)); ?>')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    class="bg-[#FAF8F5] rounded-2xl overflow-hidden hover:-translate-y-1.5 transition-all duration-300 group border border-[#C4B5A5]/40 shadow-sm hover:shadow-xl flex flex-col h-full relative">
                    <!-- Selo de Exclusivo / Categoria -->
                    <div class="absolute top-4 left-4 z-20 pointer-events-none">
                        <span
                            class="px-3 py-1 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full text-[10px] tracking-widest uppercase font-semibold text-[#2B2927] border border-[#C4B5A5]/30 shadow-sm">
                            <?php echo e($category); ?>

                        </span>
                    </div>

                    <!-- Foto do Produto com Carrossel -->
                    <div x-data="{ currentImg: 0, imagesList: <?php echo e(json_encode($images)); ?> }"
                        class="aspect-w-16 aspect-h-12 bg-[#F5F2EB] flex items-center justify-center relative overflow-hidden shrink-0 h-56 sm:h-64 border-b border-[#C4B5A5]/20 group/carousel">
                        
                        <template x-if="imagesList.length > 0">
                            <div class="w-full h-full relative">
                                <template x-for="(image, idx) in imagesList" :key="idx">
                                    <img :src="image" alt="<?php echo e($title); ?>"
                                        x-show="currentImg === idx"
                                        x-transition:enter="transition opacity ease-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        onerror="this.src='/imagem/valohome_logo.png'"
                                        class="w-full h-full object-cover cursor-pointer group-hover:scale-105 transition-transform duration-700"
                                        @click="selectedProject = { title: '<?php echo e(addslashes($title)); ?>', category: '<?php echo e(addslashes($category)); ?>', price: '<?php echo e($price); ?>', image: '<?php echo e($img); ?>', images: imagesList, description: '<?php echo e(addslashes($desc)); ?>' }; isImageModalOpen = true">
                                </template>

                                <!-- Controles do Carrossel (Setas) se houver mais de 1 imagem -->
                                <template x-if="imagesList.length > 1">
                                    <div>
                                        <button @click.stop="currentImg = (currentImg - 1 + imagesList.length) % imagesList.length"
                                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-[#2B2927]/60 hover:bg-[#2B2927] text-white rounded-full p-2 opacity-90 sm:opacity-0 group-hover/carousel:opacity-100 transition-opacity z-20 shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button @click.stop="currentImg = (currentImg + 1) % imagesList.length"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#2B2927]/60 hover:bg-[#2B2927] text-white rounded-full p-2 opacity-90 sm:opacity-0 group-hover/carousel:opacity-100 transition-opacity z-20 shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>

                                        <!-- Indicadores de Pontos (Dots) -->
                                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-20 bg-[#2B2927]/40 px-2 py-1 rounded-full backdrop-blur-sm">
                                            <template x-for="(img, idx) in imagesList" :key="idx">
                                                <button @click.stop="currentImg = idx"
                                                    :class="currentImg === idx ? 'bg-white w-3' : 'bg-white/50 w-1.5'"
                                                    class="h-1.5 rounded-full transition-all duration-300"></button>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <!-- Overlay Quick View -->
                                <div class="absolute inset-0 bg-[#2B2927]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10 pointer-events-none">
                                    <span class="px-4 py-2 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full text-[#2B2927] text-xs font-semibold uppercase tracking-wider shadow-md">
                                        Espiar Detalhes
                                    </span>
                                </div>
                            </div>
                        </template>

                        <template x-if="imagesList.length === 0">
                            <div class="w-full h-full flex items-center justify-center text-[#8C7B6C] font-light text-sm">
                                Sem Foto
                            </div>
                        </template>
                    </div>

                    <!-- Informações e Botão de Compra -->
                    <div class="p-5 sm:p-6 flex flex-col flex-1">
                        <h3
                            class="font-serif-logo text-xl sm:text-2xl font-medium text-[#2B2927] mb-2 leading-tight group-hover:text-[#8C7B6C] transition-colors">
                            <?php echo e($title); ?>

                        </h3>

                        <p class="text-xs text-[#4A4643] line-clamp-2 mb-6 font-light">
                            <?php echo e($desc); ?>

                        </p>

                        <div class="mt-auto pt-4 border-t border-[#C4B5A5]/30 flex items-center justify-between gap-2">
                            <div>
                                <span
                                    class="text-[10px] text-[#8C7B6C] uppercase font-semibold block tracking-wider">Preço</span>
                                <span class="text-lg sm:text-xl font-semibold text-[#2B2927]">
                                    R$ <?php echo e($price); ?>

                                </span>
                            </div>

                            <!-- Botão Encomendar / WhatsApp -->
                            <a href="https://wa.me/<?php echo e(config('app.whatsapp_number', '5500000000000')); ?>?text=<?php echo e(urlencode('Olá ValoHome 3D! Gostaria de encomendar a peça: ' . $title)); ?>"
                                target="_blank"
                                class="px-3.5 sm:px-4 py-2.5 rounded-full bg-[#2B2927] hover:bg-[#8C7B6C] text-[#FAF8F5] text-xs font-medium uppercase tracking-wider transition-all duration-300 flex items-center gap-1.5 shadow-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.147 4.192 4.29-1.125z" />
                                </svg>
                                Encomendar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-16 bg-[#FAF8F5] rounded-2xl border border-[#C4B5A5]/30">
                    <p class="text-[#8C7B6C] font-serif-logo text-2xl mb-1">Catálogo em atualização</p>
                    <p class="text-[#4A4643] text-sm">Os produtos adicionados aparecerão aqui em breve.</p>
                </div>
            <?php endif; ?>

        </div>

        <!-- MODAL QUICK-VIEW DO PRODUTO LOJA (Responsivo Celular) -->
        <div x-show="isImageModalOpen" style="display: none;"
            @keydown.escape.window="isImageModalOpen = false"
            x-effect="document.body.style.overflow = isImageModalOpen ? 'hidden' : ''"
            class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 overflow-y-auto">
            <!-- Fundo Escuro com desfoque -->
            <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-[#2B2927]/85 backdrop-blur-md z-[100]" @click="isImageModalOpen = false"></div>

            <!-- Modal Card do Produto -->
            <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative z-[105] bg-[#FAF8F5] border border-[#C4B5A5]/40 rounded-2xl sm:rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto my-auto">

                <!-- Botão Fechar -->
                <button @click="isImageModalOpen = false"
                    class="absolute top-3 right-3 text-[#2B2927] hover:text-[#8C7B6C] bg-[#F5F2EB] p-2 rounded-full z-30 border border-[#C4B5A5]/40 shadow-sm">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <template x-if="selectedProject">
                    <div x-data="{ modalImgIdx: 0 }" class="grid md:grid-cols-2">
                        <!-- Foto em Destaque no Modal com Carrossel e Miniaturas -->
                        <div class="bg-[#F5F2EB] flex flex-col items-center justify-center p-4 sm:p-6 border-b md:border-b-0 md:border-r border-[#C4B5A5]/30 relative min-h-[240px] sm:min-h-[350px]">
                            <div class="relative w-full h-[200px] sm:h-[300px] flex items-center justify-center">
                                <img :src="(selectedProject.images && selectedProject.images.length > 0) ? selectedProject.images[modalImgIdx] : selectedProject.image"
                                    :alt="selectedProject.title"
                                    onerror="this.src='/imagem/valohome_logo.png'"
                                    class="max-h-[200px] sm:max-h-[300px] w-full object-contain rounded-xl shadow-md transition-all duration-300">

                                <!-- Setas de navegação no Modal se houver múltiplas fotos -->
                                <template x-if="selectedProject.images && selectedProject.images.length > 1">
                                    <div>
                                        <button @click="modalImgIdx = (modalImgIdx - 1 + selectedProject.images.length) % selectedProject.images.length"
                                            class="absolute left-1 top-1/2 -translate-y-1/2 bg-[#2B2927]/70 hover:bg-[#2B2927] text-white p-2 rounded-full shadow-md z-10">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button @click="modalImgIdx = (modalImgIdx + 1) % selectedProject.images.length"
                                            class="absolute right-1 top-1/2 -translate-y-1/2 bg-[#2B2927]/70 hover:bg-[#2B2927] text-white p-2 rounded-full shadow-md z-10">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <!-- Carrossel de Miniaturas (Thumbnails) abaixo da foto principal -->
                            <template x-if="selectedProject.images && selectedProject.images.length > 1">
                                <div class="flex gap-2 mt-3 overflow-x-auto max-w-full pb-1">
                                    <template x-for="(img, idx) in selectedProject.images" :key="idx">
                                        <img :src="img"
                                            @click="modalImgIdx = idx"
                                            onerror="this.src='/imagem/valohome_logo.png'"
                                            :class="modalImgIdx === idx ? 'ring-2 ring-[#8C7B6C] scale-105 opacity-100' : 'opacity-50 hover:opacity-100'"
                                            class="w-10 h-10 sm:w-12 sm:h-12 object-cover rounded-lg cursor-pointer transition-all border border-[#C4B5A5]/40 shadow-sm">
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Detalhes do Produto no Modal -->
                        <div class="p-5 sm:p-8 flex flex-col justify-between">
                            <div>
                                <span
                                    class="px-3 py-1 bg-[#F5F2EB] rounded-full text-[10px] tracking-widest uppercase font-semibold text-[#8C7B6C] border border-[#C4B5A5]/30"
                                    x-text="selectedProject.category"></span>
                                <h2 class="font-serif-logo text-2xl sm:text-3xl font-medium text-[#2B2927] mt-3 mb-2"
                                    x-text="selectedProject.title"></h2>
                                <p class="text-[10px] sm:text-xs text-[#8C7B6C] tracking-wider uppercase font-semibold mb-3">Garantia de
                                    Qualidade ValoHome 3D</p>
                                <p class="text-xs sm:text-sm text-[#4A4643] leading-relaxed mb-4 font-light"
                                    x-text="selectedProject.description"></p>
                            </div>

                            <div class="pt-4 border-t border-[#C4B5A5]/30">
                                <div class="mb-4">
                                    <span class="text-[10px] sm:text-xs text-[#8C7B6C] uppercase font-semibold block">Valor sob consulta /
                                        pronta entrega</span>
                                    <span class="text-2xl sm:text-3xl font-semibold text-[#2B2927]">R$ <span
                                            x-text="selectedProject.price"></span></span>
                                </div>

                                <a :href="'https://wa.me/' + whatsappNumber + '?text=' + encodeURIComponent('Olá ValoHome 3D! Gostaria de tirar dúvidas / encomendar a peça: ' + selectedProject.title)"
                                    target="_blank"
                                    class="w-full py-3 sm:py-3.5 rounded-full bg-[#2B2927] hover:bg-[#8C7B6C] text-[#FAF8F5] text-xs font-semibold uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evolusat\Documents\GitHub\Shift3D\resources\views/welcome.blade.php ENDPATH**/ ?>