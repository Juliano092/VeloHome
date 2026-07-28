<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}" class="text-[#8C7B6C] hover:text-[#2B2927] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
                {{ __('Cadastrar Novo Produto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40">
                <div class="p-8">
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Título do Produto *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" 
                                placeholder="Ex: Vaso Decorativo 3D">
                            @error('title') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="category" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Categoria *</label>
                            <input type="text" name="category" id="category" value="{{ old('category') }}" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3 text-[#2B2927] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" 
                                placeholder="Ex: Decoração">
                            @error('category') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Upload da Imagem Principal (Capa) -->
                        <div>
                            <label for="image" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Foto Principal (Capa) *</label>
                            <input type="file" name="image" id="image" accept="image/*" required 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2.5 text-xs text-[#2B2927] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#2B2927] file:text-[#FAF8F5] hover:file:bg-[#8C7B6C] transition-all outline-none cursor-pointer">
                            <p class="text-xs text-[#8C7B6C] mt-1 font-light">Selecione a foto principal que aparecerá de capa.</p>
                            @error('image') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Upload de Fotos Adicionais (Galeria / Carrossel) -->
                        <div>
                            <label for="images" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Galeria de Fotos (Várias Imagens / Carrossel)</label>
                            <input type="file" name="images[]" id="images" accept="image/*" multiple 
                                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-2.5 text-xs text-[#2B2927] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#8C7B6C] file:text-[#FAF8F5] hover:file:bg-[#2B2927] transition-all outline-none cursor-pointer">
                            <p class="text-xs text-[#8C7B6C] mt-1 font-light">Você pode selecionar **múltiplas fotos** de uma vez segurando a tecla Ctrl.</p>
                            @error('images') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Valor do Produto -->
                        <div>
                            <label for="price" class="block text-xs font-semibold text-[#8C7B6C] uppercase tracking-wider mb-1">Valor do Produto (R$) *</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required 
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
                                Salvar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
