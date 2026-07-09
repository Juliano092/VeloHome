<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Shift3D Portfolio') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Tailwind CSS (via CDN temporariamente para contornar a versão do Node) -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
        
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                --color-glass: rgba(15, 23, 42, 0.4);
                --color-glass-border: rgba(255, 255, 255, 0.08);
            }
            body {
                font-family: var(--font-sans);
                background-color: #030712; /* gray-950 */
                color: #f8fafc; /* slate-50 */
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            /* Efeitos de brilho no fundo */
            .bg-glow {
                position: absolute;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, rgba(0,0,0,0) 70%);
                top: -200px;
                left: -200px;
                border-radius: 50%;
                z-index: -1;
                filter: blur(60px);
            }
            .bg-glow-2 {
                position: absolute;
                width: 800px;
                height: 800px;
                background: radial-gradient(circle, rgba(168,85,247,0.15) 0%, rgba(0,0,0,0) 70%);
                bottom: -300px;
                right: -200px;
                border-radius: 50%;
                z-index: -1;
                filter: blur(80px);
            }
            .glass-panel {
                background-color: var(--color-glass);
                backdrop-filter: blur(16px);
                border: 1px solid var(--color-glass-border);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body class="antialiased selection:bg-cyan-500/30 selection:text-cyan-200">
        <!-- Background Glows -->
        <div class="bg-glow"></div>
        <div class="bg-glow-2"></div>

        <!-- Navegação Pública -->
        <nav class="fixed w-full z-50 glass-panel border-b-0 border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-purple-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                            </svg>
                        </div>
                        <a href="/" class="text-2xl font-black tracking-tight text-white">
                            Shift<span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-500">3D</span>
                        </a>
                    </div>
                    <div>
                        <!-- Botão removido para garantir que a página seja 100% focada no cliente -->
                    </div>
                </div>
            </div>
        </nav>

        <!-- Conteúdo da Página -->
        <main class="pt-32 pb-20 min-h-[85vh]">
            @yield('content')
        </main>
        
        <footer class="py-8 text-center text-sm text-gray-500 border-t border-white/5">
            &copy; {{ date('Y') }} Shift3D. Inovação em Visualização.
        </footer>
    </body>
</html>
