<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        
        <!-- Tailwind CDN for development without Node -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            }
            body {
                /* Azul escuro profundo e profissional */
                background-color: #0B132B;
                position: relative;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="font-sans text-gray-100 antialiased selection:bg-cyan-500/30 selection:text-cyan-200">
        
        <!-- Fundo Azul Escuro Principal -->
        <div class="absolute inset-0 bg-[#0B132B] z-0"></div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center relative z-10 px-4">
            
            <!-- Main Glass Card -->
            <div class="w-full max-w-5xl flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-[0_0_50px_rgba(0,0,0,0.8)] border border-white/10 backdrop-blur-2xl bg-[#000000]/60 h-[600px] relative z-20">
                
                <!-- Lado Esquerdo: Formulário -->
                <div class="w-full md:w-1/2 bg-[#000000]/40 p-12 flex flex-col justify-center relative z-20 border-r border-white/5">
                    <div class="mb-10">
                        <a href="/" class="text-3xl font-black tracking-tight text-white flex items-center gap-3">
                            <span translate="no">Shift<span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">3D</span></span>
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>

                <!-- Lado Direito: Imagem -->
                <div class="hidden md:flex w-1/2 bg-transparent relative items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500/10 to-blue-500/10 mix-blend-overlay z-10 pointer-events-none"></div>
                    
                    <img src="{{ asset('imagem/logo.png') }}" alt="Logo da Empresa" class="absolute inset-0 w-full h-full object-contain z-0 hover:scale-[1.03] transition-transform duration-1000 opacity-90 hover:opacity-100">
                </div>

            </div>

        </div>
    </body>
</html>
