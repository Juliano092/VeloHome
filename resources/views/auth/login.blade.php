<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div>
        <h2 class="font-serif-logo text-3xl font-medium text-[#2B2927] mb-1">Acesso Restrito</h2>
        <p class="text-[#8C7B6C] text-xs uppercase tracking-wider font-semibold mb-6">Painel Administrativo ValoHome 3D</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3.5 text-[#2B2927] placeholder-[#8C7B6C] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" placeholder="E-mail de acesso">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="w-full bg-[#F5F2EB] border border-[#C4B5A5]/50 rounded-xl px-4 py-3.5 text-[#2B2927] placeholder-[#8C7B6C] focus:bg-[#FAF8F5] focus:ring-2 focus:ring-[#8C7B6C]/30 focus:border-[#2B2927] transition-all outline-none text-sm" placeholder="Sua senha">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-[#F5F2EB] border-[#C4B5A5] text-[#2B2927] focus:ring-[#8C7B6C]/30" name="remember">
                <span class="ms-2 text-xs text-[#4A4643] group-hover:text-[#2B2927] transition-colors">Lembrar-me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-[#8C7B6C] hover:text-[#2B2927] transition-colors" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3.5 bg-[#2B2927] text-[#FAF8F5] rounded-xl font-medium text-xs uppercase tracking-widest hover:bg-[#8C7B6C] shadow-lg hover:scale-[1.01] active:scale-95 transition-all duration-300">
                Entrar no Painel
            </button>
        </div>
    </form>
</x-guest-layout>
