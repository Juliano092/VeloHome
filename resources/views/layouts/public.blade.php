<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'ValoHome 3D - Design & Value') }}</title>
        
        <!-- Fonts: Playfair Display / Cormorant & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
        
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'Plus Jakarta Sans', system-ui, sans-serif;
                --font-serif: 'Cormorant Garamond', Georgia, serif;
                --color-beige-bg: #F5F2EB;
                --color-beige-card: #FAF8F5;
                --color-taupe: #C4B5A5;
                --color-taupe-dark: #8C7B6C;
                --color-charcoal: #2B2927;
                --color-charcoal-light: #4A4643;
            }
            body {
                font-family: var(--font-sans);
                background-color: #F5F2EB; /* Fundo Creme / Beige Claro da Logo */
                color: #2B2927; /* Texto Grafite Elegante */
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }
            .font-serif-logo {
                font-family: 'Cormorant Garamond', serif;
            }
            /* Efeitos suaves de fundo baseados na logo */
            .bg-glow-subtle {
                position: absolute;
                width: 700px;
                height: 700px;
                background: radial-gradient(circle, rgba(196,181,165,0.25) 0%, rgba(245,242,235,0) 70%);
                top: -200px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 50%;
                z-index: -1;
                filter: blur(80px);
            }
            .glass-panel-light {
                background-color: rgba(250, 248, 245, 0.85);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(196, 181, 165, 0.4);
                box-shadow: 0 10px 30px -10px rgba(43, 41, 39, 0.05);
            }
        </style>
    </head>
    <body class="antialiased selection:bg-[#C4B5A5]/30 selection:text-[#2B2927]">
        <!-- Background Glow -->
        <div class="bg-glow-subtle"></div>

        <!-- Navegação Pública -->
        <nav class="fixed w-full z-50 glass-panel-light border-b border-[#C4B5A5]/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <!-- Ícone do V + Casa estilizado da Logo -->
                        <div class="w-10 h-10 rounded-full border border-[#C4B5A5] bg-[#FAF8F5] flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-[#2B2927]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <a href="/" class="flex flex-col">
                            <span class="font-serif-logo text-2xl font-semibold tracking-wider text-[#2B2927] leading-none">valohome <span class="text-xs font-sans tracking-widest text-[#8C7B6C] font-normal uppercase">3D</span></span>
                            <span class="text-[9px] tracking-[0.25em] text-[#8C7B6C] uppercase font-medium mt-0.5">Design & Value</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Conteúdo da Página -->
        <main class="pt-32 pb-20 min-h-[85vh]">
            @yield('content')
        </main>
        
        <footer class="py-10 text-center border-t border-[#C4B5A5]/40 bg-[#FAF8F5]">
            <p class="font-serif-logo text-xl text-[#2B2927] mb-1">valohome</p>
            <p class="text-xs tracking-[0.2em] text-[#8C7B6C] uppercase font-medium mb-4">DESIGN & VALUE</p>
            <p class="text-xs text-[#4A4643]">
                &copy; {{ date('Y') }} ValoHome 3D. Todos os direitos reservados.
            </p>
        </footer>
    </body>
</html>
