<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ValoHome 3D') }} - Login</title>

        <!-- Fonts: Cormorant Garamond & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'Plus Jakarta Sans', system-ui, sans-serif;
                --font-serif: 'Cormorant Garamond', Georgia, serif;
            }
            body {
                background-color: #F5F2EB;
                color: #2B2927;
                position: relative;
                overflow: hidden;
            }
            .font-serif-logo {
                font-family: 'Cormorant Garamond', serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased selection:bg-[#C4B5A5]/30 selection:text-[#2B2927]">
        
        <!-- Fundo Sutil -->
        <div class="absolute inset-0 bg-[#F5F2EB] z-0"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-radial from-[#C4B5A5]/20 to-transparent rounded-full filter blur-3xl z-0 pointer-events-none"></div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center relative z-10 px-4">
            
            <!-- Card Principal de Login estilo Boutique -->
            <div class="w-full max-w-4xl flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-2xl border border-[#C4B5A5]/40 bg-[#FAF8F5] min-h-[550px] relative z-20">
                
                <!-- Lado Esquerdo: Formulário -->
                <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative z-20 border-b md:border-b-0 md:border-r border-[#C4B5A5]/30">
                    <div class="mb-8">
                        <a href="/" class="flex flex-col">
                            <span class="font-serif-logo text-3xl font-semibold tracking-wider text-[#2B2927] leading-none">valohome <span class="text-xs font-sans tracking-widest text-[#8C7B6C] font-normal uppercase">3D</span></span>
                            <span class="text-[9px] tracking-[0.25em] text-[#8C7B6C] uppercase font-medium mt-1">Design & Value</span>
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>

                <!-- Lado Direito: Identidade Visual da Marca -->
                <div class="hidden md:flex w-1/2 bg-[#F5F2EB] relative items-center justify-center p-12 flex-col text-center">
                    <div class="w-20 h-20 rounded-full border border-[#C4B5A5] bg-[#FAF8F5] flex items-center justify-center shadow-md mb-6">
                        <svg class="w-10 h-10 text-[#8C7B6C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif-logo text-3xl text-[#2B2927] font-medium mb-2">Painel de Gestão</h3>
                    <p class="text-xs text-[#8C7B6C] uppercase tracking-[0.2em] font-semibold mb-4">ValoHome 3D</p>
                    <p class="text-xs text-[#4A4643] max-w-xs font-light leading-relaxed">
                        Área exclusiva para administração de produtos, portfólio e cálculo de orçamentos de impressão 3D.
                    </p>
                </div>

            </div>

        </div>
    </body>
</html>
