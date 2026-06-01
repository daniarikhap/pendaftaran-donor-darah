<x-guest-layout>
    <!-- Welcome Header -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">
            Lupa Kata Sandi?
        </h2>
        <p class="text-sm text-slate-500 mt-2">
            Jangan khawatir. Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <label for="email" class="block font-semibold text-sm text-slate-700">{{ __('Email') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Mail icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm" placeholder="nama@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 active:from-red-700 active:to-rose-700 text-white font-bold text-sm tracking-wider uppercase rounded-xl shadow-lg shadow-rose-500/25 hover:shadow-rose-500/35 transition duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                <span>{{ __('Kirim Tautan Atur Ulang') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
        
        <!-- Back to Login Link -->
        <div class="text-center pt-2">
            <p class="text-sm text-slate-500">
                Kembali ke 
                <a href="{{ route('login') }}" class="font-bold text-rose-600 hover:text-rose-500 hover:underline transition duration-150">
                    Halaman Masuk
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
