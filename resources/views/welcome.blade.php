@extends('layouts.public')

@section('content')
<div x-data="{ isImageModalOpen: false, modalImageUrl: '' }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center py-20 relative">
        <h1 class="text-5xl font-black tracking-tight sm:text-7xl mb-6 drop-shadow-2xl">
            Explore Nosso <br/><span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-500">Universo 3D</span>
        </h1>
        <p class="mt-6 text-xl text-gray-400 max-w-2xl mx-auto font-light leading-relaxed">
            Uma galeria imersiva e de alta performance. Descubra modelos e renderizações 3D que desafiam os limites da criação digital.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            <a href="#galeria" class="px-8 py-3 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold hover:shadow-[0_0_30px_rgba(6,182,212,0.4)] transition-all hover:scale-105">
                Ver Portfólio
            </a>
        </div>
    </div>

    <!-- Galeria de Projetos -->
    <div id="galeria" class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        
        @forelse($projects as $project)
            <!-- Card -->
            <div class="glass-panel rounded-2xl overflow-hidden hover:scale-[1.03] transition-all duration-300 group border border-white/5 hover:border-cyan-500/30 hover:shadow-[0_0_40px_rgba(6,182,212,0.15)] relative flex flex-col h-full">
                
                <!-- Thumbnail -->
                <div class="aspect-w-16 aspect-h-10 bg-gray-900 flex items-center justify-center relative overflow-hidden shrink-0 h-48">
                    @if(isset($project['image_url']))
                        <img src="{{ $project['image_url'] }}" alt="{{ $project['title'] ?? 'Produto' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <!-- Eye Button Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                            <button @click="modalImageUrl = '{{ $project['image_url'] }}'; isImageModalOpen = true" class="p-3 bg-white/10 backdrop-blur-md rounded-full text-white hover:bg-cyan-500/80 hover:text-white hover:scale-110 transition-all shadow-[0_0_20px_rgba(6,182,212,0.5)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-700">Sem Foto</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#030712] via-transparent to-transparent opacity-90"></div>
                </div>
                
                <div class="p-6 relative z-20 flex flex-col flex-1 -mt-10">
                    <div class="flex justify-between items-start mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 backdrop-blur-md">
                            {{ $project['category'] ?? 'Sem Categoria' }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4 drop-shadow-md">{{ $project['title'] ?? 'Projeto sem Título' }}</h3>
                    
                    <div class="flex items-center text-xl text-green-400 font-black mt-auto">
                        R$ {{ isset($project['price']) ? number_format($project['price'], 2, ',', '.') : '0,00' }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Nenhum projeto cadastrado no momento.</p>
                <p class="text-gray-600 text-sm mt-2">Os projetos adicionados pelo painel admin aparecerão aqui automaticamente.</p>
            </div>
        @endforelse

    </div>

    <!-- MODAL DE VISUALIZAÇÃO DE IMAGEM -->
    <div x-show="isImageModalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden">
        <!-- Fundo escuro com desfoque -->
        <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/90 backdrop-blur-xl" @click="isImageModalOpen = false"></div>
        
        <!-- Botão Fechar -->
        <button @click="isImageModalOpen = false" class="absolute top-6 right-6 text-gray-400 hover:text-white transition-colors z-[110] bg-black/50 p-2 rounded-full hover:bg-black/80">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <!-- Imagem Ampliada -->
        <div x-show="isImageModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative z-[105] max-w-5xl w-full max-h-[90vh] px-4 flex justify-center items-center">
            <img :src="modalImageUrl" alt="Visualização" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-[0_0_50px_rgba(6,182,212,0.3)] ring-1 ring-white/10">
        </div>
    </div>

</div>
@endsection
