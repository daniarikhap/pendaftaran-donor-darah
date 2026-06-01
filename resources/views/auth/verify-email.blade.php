<x-guest-layout>
    <!-- Welcome Header -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="text-3xl font-extrabold tracking-tight text-slate-800">
            Verifikasi Email
        </h2>
        <p class="text-sm text-slate-500 mt-2">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke email Anda. Jika tidak menerimanya, kami akan mengirimkan yang baru.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 active:from-red-700 active:to-rose-700 text-white font-bold text-sm tracking-wider uppercase rounded-xl shadow-lg shadow-rose-500/25 hover:shadow-rose-500/35 transition duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                    <span>{{ __('Kirim Ulang Email Verifikasi') }}</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="underline text-sm text-slate-500 hover:text-slate-800 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500/20 font-bold transition duration-150">
                {{ __('Keluar Akun') }}
            </button>
        </form>
    </div>
</x-guest-layout>
