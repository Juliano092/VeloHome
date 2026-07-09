<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Projetos 3D') }}
            </h2>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg font-semibold hover:shadow-[0_0_15px_rgba(6,182,212,0.4)] transition-all">
                + Novo Projeto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-500/20 border border-green-500/30 text-green-300 rounded-lg backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass-panel overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400">
                                <th class="pb-3 px-4 font-semibold">Capa</th>
                                <th class="pb-3 px-4 font-semibold">Título</th>
                                <th class="pb-3 px-4 font-semibold">Categoria</th>
                                <th class="pb-3 px-4 font-semibold text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="w-16 h-12 bg-gray-800 rounded overflow-hidden">
                                            @if(isset($project['image_url']))
                                                <img src="{{ $project['image_url'] }}" alt="" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 font-medium text-white">{{ $project['title'] ?? 'Sem Título' }}</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                            {{ $project['category'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        <form action="{{ route('admin.projects.destroy', $project['id']) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 font-semibold text-sm transition-colors">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">
                                        Nenhum projeto encontrado no Firebase.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
