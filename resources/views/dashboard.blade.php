<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Painel Inicial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card Projetos -->
                <div class="bg-[#0B132B]/80 backdrop-blur-md overflow-hidden shadow-lg sm:rounded-2xl border border-white/10 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Total de Projetos</p>
                        <p class="text-3xl font-bold text-white mt-2">--</p>
                    </div>
                    <div class="p-3 bg-cyan-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card Vendas (Placeholder) -->
                <div class="bg-[#0B132B]/80 backdrop-blur-md overflow-hidden shadow-lg sm:rounded-2xl border border-white/10 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Vendas (Mês)</p>
                        <p class="text-3xl font-bold text-white mt-2">R$ 0,00</p>
                    </div>
                    <div class="p-3 bg-emerald-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card Visitas (Placeholder) -->
                <div class="bg-[#0B132B]/80 backdrop-blur-md overflow-hidden shadow-lg sm:rounded-2xl border border-white/10 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Visualizações</p>
                        <p class="text-3xl font-bold text-white mt-2">0</p>
                    </div>
                    <div class="p-3 bg-purple-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-[#0B132B]/80 backdrop-blur-md overflow-hidden shadow-lg sm:rounded-2xl border border-white/10">
                <div class="p-8 text-gray-200">
                    <h3 class="text-2xl font-bold text-white mb-2">Bem-vindo ao Shift3D Painel</h3>
                    <p class="text-gray-400">Você está conectado como Administrador. Utilize o menu superior para gerenciar suas Vendas e Portfólio de Produtos.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
