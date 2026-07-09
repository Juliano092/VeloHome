<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div>
        <h2 class="text-2xl font-bold text-white mb-2">Login Admin</h2>
        <p class="text-gray-400 text-sm mb-8">Acesse o painel para gerenciar seus projetos 3D.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:bg-white/10 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all outline-none backdrop-blur-sm" placeholder="E-mail">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-gray-500 focus:bg-white/10 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all outline-none backdrop-blur-sm" placeholder="Senha">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-cyan-500 shadow-sm focus:ring-cyan-500/50" name="remember">
                <span class="ms-2 text-sm text-gray-400 group-hover:text-white transition-colors">Lembrar-me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-400 hover:text-cyan-400 transition-colors" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl font-bold text-lg shadow-[0_0_20px_rgba(6,182,212,0.3)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] hover:scale-[1.02] active:scale-95 transition-all duration-300">
                Acessar Painel
            </button>
        </div>
    </form>
</x-guest-layout>
