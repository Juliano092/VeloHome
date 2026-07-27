<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] leading-tight">
            {{ __('Portfólio (Produtos)') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-[#C4B5A5]/20 border border-[#8C7B6C]/40 text-[#4A2E2B] rounded-xl font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header da Seção -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-serif-logo text-3xl font-medium text-[#2B2927]">Gerenciar Produtos</h3>
                <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 bg-[#4A2E2B] hover:bg-[#3E2723] text-[#FAF8F5] rounded-full font-medium text-xs uppercase tracking-wider shadow-md hover:scale-105 transition-all duration-300 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#C4B5A5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Novo Produto
                </a>
            </div>

            <!-- Tabela de Produtos -->
            <div class="bg-[#FAF8F5] overflow-hidden shadow-sm sm:rounded-2xl border border-[#C4B5A5]/40">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="border-b border-[#C4B5A5]/40 text-[#8C7B6C] text-xs uppercase tracking-wider font-semibold">
                                <th class="pb-4 px-4 font-semibold">Imagem</th>
                                <th class="pb-4 px-4 font-semibold">Título</th>
                                <th class="pb-4 px-4 font-semibold">Categoria</th>
                                <th class="pb-4 px-4 font-semibold text-right">Preço (R$)</th>
                                <th class="pb-4 px-4 font-semibold text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#C4B5A5]/20 text-sm">
                            @forelse($projects ?? [] as $project)
                                <tr class="hover:bg-[#F5F2EB]/60 transition-colors">
                                    <td class="py-3 px-4">
                                        @if(isset($project['image_url']))
                                            <img src="{{ $project['image_url'] }}" alt="{{ $project['title'] ?? 'Sem título' }}" class="w-12 h-12 object-cover rounded-xl border border-[#C4B5A5]/40">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-[#F5F2EB] flex items-center justify-center text-[#8C7B6C] text-xs font-medium">Sem foto</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 font-semibold text-[#2B2927]">{{ $project['title'] ?? 'Sem título' }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-semibold bg-[#F5F2EB] text-[#8C7B6C] border border-[#C4B5A5]/40">
                                            {{ $project['category'] ?? 'Sem categoria' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-[#4A2E2B] font-bold text-right whitespace-nowrap text-base">
                                        R$ {{ number_format($project['price'] ?? 0, 2, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('admin.projects.edit', $project['id']) }}" class="text-[#8C7B6C] hover:text-[#4A2E2B] font-semibold text-xs uppercase tracking-wider transition-colors flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project['id']) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-700 hover:text-rose-900 font-semibold text-xs uppercase tracking-wider transition-colors flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[#8C7B6C] font-light">
                                        Nenhum produto cadastrado ainda.
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
