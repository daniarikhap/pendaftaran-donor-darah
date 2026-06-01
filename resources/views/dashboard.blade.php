<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-rose-100 p-8 text-center relative">
                <!-- Abstract glowing backgrounds (subtle light-themed) -->
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-rose-50/60 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-red-50/50 blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col items-center py-6">
                    <!-- Heart Icon -->
                    <div class="bg-rose-50 p-4 rounded-3xl border border-rose-100/80 mb-5 text-rose-600 shadow-md shadow-rose-100/30">
                        <svg class="w-12 h-12 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                        Selamat Datang Admin
                    </h3>
                    
                    <p class="text-sm text-slate-500 mt-2 max-w-md leading-relaxed">
                        Anda telah berhasil masuk ke sistem manajemen pendaftaran donor darah. Gunakan menu di sebelah kiri untuk menavigasi dan mengelola kuesioner serta data informasi donor.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
