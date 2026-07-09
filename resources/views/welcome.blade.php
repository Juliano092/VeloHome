@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <a href="{{ $project['model_url'] ?? '#' }}" target="_blank" class="glass-panel rounded-2xl overflow-hidden hover:scale-[1.03] transition-all duration-300 group cursor-pointer border border-white/5 hover:border-cyan-500/30 hover:shadow-[0_0_40px_rgba(6,182,212,0.15)] relative flex flex-col h-full">
                <div class="absolute inset-0 bg-gradient-to-t from-[#030712] via-transparent to-transparent z-10 opacity-80 group-hover:opacity-60 transition-opacity"></div>
                
                <div class="aspect-w-16 aspect-h-10 bg-gray-900 flex items-center justify-center relative overflow-hidden shrink-0">
                    <!-- Thumbnail -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:opacity-70 group-hover:scale-110 transition-all duration-700" style="background-image: url('{{ $project['image_url'] ?? '' }}')"></div>
                </div>
                
                <div class="p-6 relative z-20 flex flex-col flex-1 -mt-16">
                    <div class="flex justify-between items-start mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 backdrop-blur-md">
                            {{ $project['category'] ?? '3D' }}
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2 drop-shadow-md">{{ $project['title'] ?? 'Projeto sem Título' }}</h3>
                    <p class="text-gray-400 text-sm mb-5 line-clamp-2 flex-1">
                        {{ $project['description'] ?? '' }}
                    </p>
                    <div class="flex items-center text-sm text-cyan-400 font-semibold group-hover:text-cyan-300 transition-colors mt-auto">
                        Explorar Modelo 3D <span class="ml-2 group-hover:translate-x-2 transition-transform">→</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Nenhum projeto cadastrado no momento.</p>
                <p class="text-gray-600 text-sm mt-2">Os projetos adicionados pelo painel admin aparecerão aqui automaticamente.</p>
            </div>
        @endforelse

    </div>
</div>
@endsection
