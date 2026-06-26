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
                <!-- Card Total Donor -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-blue-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Donor</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalDonor }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Pendaftaran donor</p>
                    </div>
                    <div class="bg-blue-50 p-3.5 rounded-2xl text-blue-600 border border-blue-100 shadow-sm transition-colors duration-300 group-hover:bg-blue-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- User registration icon -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Donor Berhasil -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-emerald-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Donor Berhasil</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $donorBerhasil }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Donor berhasil</p>
                    </div>
                    <div class="bg-emerald-50 p-3.5 rounded-2xl text-emerald-600 border border-emerald-100 shadow-sm transition-colors duration-300 group-hover:bg-emerald-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Shield Check / Done icon -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Jumlah Pendonor -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-rose-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Pendonor</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahPendonor }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Pendonor terdaftar</p>
                    </div>
                    <div class="bg-rose-50 p-3.5 rounded-2xl text-rose-600 border border-rose-100 shadow-sm transition-colors duration-300 group-hover:bg-rose-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Heart representing donors/care -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card Kuesioner -->
                <div class="bg-white overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 sm:rounded-2xl border border-slate-100 p-6 flex items-center justify-between relative group">
                    <div class="absolute -right-4 -top-4 w-16 h-16 rounded-full bg-amber-50/40 group-hover:scale-110 transition-transform duration-300 pointer-events-none"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Jumlah Kuesioner</p>
                        <h4 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $jumlahKuesioner }}</h4>
                        <p class="text-xs text-slate-400 mt-1">Kuesioner aktif & non-aktif</p>
                    </div>
                    <div class="bg-amber-50 p-3.5 rounded-2xl text-amber-600 border border-amber-100 shadow-sm transition-colors duration-300 group-hover:bg-amber-100/80">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Clipboard list for questionnaire -->
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
