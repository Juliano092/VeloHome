<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Editar Produto') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    <form action="{{ route('admin.projects.update', $project['id']) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Título do Produto</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $project['title'] ?? '') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:bg-white/10 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all outline-none" 
                                placeholder="Ex: Cadeira Eames 3D">
                            @error('title') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Categoria</label>
                            <input type="text" name="category" id="category" value="{{ old('category', $project['category'] ?? '') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:bg-white/10 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all outline-none" 
                                placeholder="Ex: Móveis">
                            @error('category') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Upload da Imagem -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-300 mb-1">Foto do Produto (Capa)</label>
                            
                            @if(isset($project['image_url']))
                                <div class="mb-3">
                                    <p class="text-xs text-gray-400 mb-1">Imagem Atual:</p>
                                    <img src="{{ $project['image_url'] }}" alt="" class="w-32 h-24 object-cover rounded-lg border border-white/10">
                                </div>
                            @endif

                            <input type="file" name="image" id="image" accept="image/*" 
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/20 file:text-cyan-400 hover:file:bg-cyan-500/30 transition-all outline-none cursor-pointer">
                            <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter a imagem atual.</p>
                            @error('image') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Valor do Produto -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-300 mb-1">Valor do Produto (R$)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $project['price'] ?? '') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:bg-white/10 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all outline-none" 
                                placeholder="Ex: 199.90">
                            @error('price') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-white/10">
                            <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 rounded-xl font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl font-bold shadow-[0_0_15px_rgba(6,182,212,0.3)] hover:shadow-[0_0_25px_rgba(6,182,212,0.5)] hover:scale-[1.02] active:scale-95 transition-all duration-300">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
