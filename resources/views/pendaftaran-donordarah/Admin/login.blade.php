<x-guest-layout>
    <!-- Welcome Header -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">
            Selamat Datang
        </h2>
        <p class="text-sm text-slate-500 mt-2">
            Silakan masuk untuk mengakses sistem pendaftaran dan riwayat donor darah Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
        @csrf

        <!-- Nomor Induk Pegawai (NIP) -->
        <div class="space-y-1.5">
            <label for="nomorindukpegawai"
                class="block font-semibold text-sm text-slate-700">{{ __('Nomor Induk Pegawai (NIP)') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- ID badge icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <input id="nomorindukpegawai" type="text" name="nomorindukpegawai"
                    value="{{ old('nomorindukpegawai') }}" required autofocus autocomplete="username"
                    class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm"
                    placeholder="Masukkan NIP Anda" />
            </div>
            <x-input-error :messages="$errors->get('nomorindukpegawai')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label for="password" class="block font-semibold text-sm text-slate-700">{{ __('Password') }}</label>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Lock icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 shadow-sm"
                    placeholder="Masukkan kata sandi Anda" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 active:from-red-700 active:to-rose-700 text-white font-bold text-sm tracking-wider uppercase rounded-xl shadow-lg shadow-rose-500/25 hover:shadow-rose-500/35 transition duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                <span>{{ __('Masuk Ke Akun') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
        <div class="text-center lg:text-left pt-6 border-t border-slate-100 mt-8">
            <p class="text-sm text-slate-500">
                <a href="{{ url('/') }}"
                    class="font-bold text-rose-600 hover:text-rose-500 transition duration-150">
                    Masuk Ke Akun Pendonor &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
