<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistic Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card Pegawai -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-blue-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Pegawai</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahPegawai }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Pegawai terdaftar</p>
                    </div>
                    <div class="bg-blue-50 p-3.5 rounded-2xl text-blue-600 border border-blue-100 shadow-sm transition-colors duration-300 group-hover:bg-blue-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Ruangan -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-amber-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Ruangan</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahRuangan }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Ruangan donor aktif</p>
                    </div>
                    <div class="bg-amber-50 p-3.5 rounded-2xl text-amber-600 border border-amber-100 shadow-sm transition-colors duration-300 group-hover:bg-amber-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>

                <!-- Card Pendonor -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-rose-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Pendonor</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahPendonor }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Pendonor terdaftar</p>
                    </div>
                    <div class="bg-rose-50 p-3.5 rounded-2xl text-rose-600 border border-rose-100 shadow-sm transition-colors duration-300 group-hover:bg-rose-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Kuesioner -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-emerald-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Kuesioner</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahKuesioner }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Kuesioner aktif & non-aktif</p>
                    </div>
                    <div class="bg-emerald-50 p-3.5 rounded-2xl text-emerald-600 border border-emerald-100 shadow-sm transition-colors duration-300 group-hover:bg-emerald-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Welcome Banner -->
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
