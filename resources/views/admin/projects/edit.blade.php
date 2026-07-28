<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}" class="text-[#8C7B6C] hover:text-[#2B2927] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
                {{ __('Editar Produto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40">
                <div class="p-8">
                    <form action="{{ route('admin.projects.update', $project['id']) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Título do Produto *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $project['title'] ?? '') }}" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" 
                                placeholder="Ex: Vaso Decorativo 3D">
                            @error('title') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @errorEnd @enderror
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="category" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Categoria *</label>
                            <input type="text" name="category" id="category" value="{{ old('category', $project['category'] ?? '') }}" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" 
                                placeholder="Ex: Decoração">
                            @error('category') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Upload da Imagem -->
                        <div>
                            <label for="image" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Fotos do Produto (Galeria & Capa)</label>
                            
                            @php
                                $currentImages = $project['images'] ?? (isset($project['image_url']) ? [$project['image_url']] : []);
                            @endphp

                            @if(!empty($currentImages))
                                <div class="mb-3">
                                    <p class="text-xs text-[#8C7B6C] mb-2 font-medium">Galeria Atual de Fotos ({{ count($currentImages) }}):</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($currentImages as $index => $imgUrl)
                                            <div class="relative group">
                                                <img src="{{ $imgUrl }}" alt="" class="w-24 h-20 object-cover rounded-xl border border-[#C4B5A5]/40 shadow-sm">
                                                @if($index === 0)
                                                    <span class="absolute top-1 left-1 bg-[#2B2927]/80 text-white text-[9px] px-1.5 py-0.5 rounded-md uppercase font-semibold">Capa</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3">
                                <div>
                                    <label for="image" class="block text-xs text-[#4A4643] mb-1 font-medium">Substituir Foto Principal (Capa)</label>
                                    <input type="file" name="image" id="image" accept="image/*" 
                                        class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2 text-xs text-[#2B2927] file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#2B2927] file:text-[#FAF8F5] hover:file:bg-[#8C7B6C] transition-all outline-none cursor-pointer">
                                </div>

                                <div>
                                    <label for="images" class="block text-xs text-[#4A4643] mb-1 font-medium">Adicionar Mais Fotos à Galeria (Múltiplas)</label>
                                    <input type="file" name="images[]" id="images" accept="image/*" multiple 
                                        class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2 text-xs text-[#2B2927] file:mr-4 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#8C7B6C] file:text-[#FAF8F5] hover:file:bg-[#2B2927] transition-all outline-none cursor-pointer">
                                </div>
                            </div>
                            <p class="text-xs text-[#8C7B6C] mt-2 font-light">Deixe os campos em branco se não desejar alterar as fotos.</p>
                            @error('image') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                            @error('images') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Valor do Produto -->
                        <div>
                            <label for="price" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Valor do Produto (R$) *</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $project['price'] ?? '') }}" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" 
                                placeholder="Ex: 199.90">
                            @error('price') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-[#C4B5A5]/30">
                            <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-full font-semibold text-xs uppercase tracking-wider text-[#8C7B6C] hover:text-[#2B2927] transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" class="px-6 py-3 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-md hover:scale-105 transition-all duration-300">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
