<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ValoHome 3D') }} - Painel</title>

        <!-- Favicon / Logo do Navegador com cache buster -->
        <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('imagem/favicon_small.png') }}?v=2">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v=2">

        <!-- Fonts: Cormorant Garamond & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
        
        <!-- Tailwind CSS -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
            @theme {
                --font-sans: 'Plus Jakarta Sans', system-ui, sans-serif;
                --font-serif: 'Cormorant Garamond', Georgia, serif;
                --color-glass: rgba(250, 248, 245, 0.9);
                --color-glass-border: rgba(196, 181, 165, 0.3);
            }
            body {
                background-color: #F5F2EB;
                color: #2B2927;
                position: relative;
                overflow-x: hidden;
            }
            .font-serif-logo {
                font-family: 'Cormorant Garamond', serif;
            }
            .glass-panel-light {
                background-color: var(--color-glass);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid var(--color-glass-border);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-[#2B2927] selection:bg-[#C4B5A5]/30 selection:text-[#2B2927]">
        <div class="h-screen flex overflow-hidden">
            
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F5F2EB]">
                <!-- Page Heading -->
                @isset($header)
                    <header class="glass-panel-light z-10 shrink-0">
                        <div class="py-5 px-8 text-[#2B2927] flex justify-between items-center">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
