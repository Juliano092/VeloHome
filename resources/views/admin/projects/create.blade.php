<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Cadastrar Novo Projeto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-8">
                    
                    @if ($errors->any())
                        <div class="mb-4 px-4 py-3 bg-red-500/20 border border-red-500/30 text-red-300 rounded-lg">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.projects.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Título do Projeto</label>
                            <input type="text" name="title" required class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: Motor Gráfico Alpha">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Categoria</label>
                            <input type="text" name="category" required class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all outline-none" placeholder="Ex: Renderização, Arquitetura, etc">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Descrição</label>
                            <textarea name="description" rows="4" required class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all outline-none" placeholder="Detalhes sobre o projeto..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">URL da Imagem de Capa</label>
                            <input type="url" name="image_url" required class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all outline-none" placeholder="https://...">
                            <p class="text-xs text-gray-500 mt-1">Coloque o link direto da imagem que será a capa (miniatura) na galeria.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">URL do Modelo 3D</label>
                            <input type="url" name="model_url" required class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all outline-none" placeholder="https://...">
                            <p class="text-xs text-gray-500 mt-1">Coloque o link do visualizador 3D (ex: Sketchfab, Spline, etc).</p>
                        </div>

                        <div class="pt-4 flex justify-end gap-4">
                            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 text-gray-400 hover:text-white transition-colors font-semibold">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-bold hover:shadow-[0_0_20px_rgba(6,182,212,0.4)] transition-all">
                                Salvar Projeto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
