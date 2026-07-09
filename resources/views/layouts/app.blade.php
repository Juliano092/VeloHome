<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                --color-glass: rgba(15, 23, 42, 0.4);
                --color-glass-border: rgba(255, 255, 255, 0.08);
            }
            body {
                background-color: #030712;
                position: relative;
                overflow-x: hidden;
            }
            .bg-glow {
                position: absolute;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(6,182,212,0.15) 0%, rgba(0,0,0,0) 70%);
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 50%;
                z-index: -1;
                filter: blur(60px);
            }
            .glass-panel {
                background-color: var(--color-glass);
                backdrop-filter: blur(16px);
                border: 1px solid var(--color-glass-border);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-100 selection:bg-cyan-500/30 selection:text-cyan-200">
        <div class="bg-glow"></div>
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="glass-panel border-b border-white/10">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
