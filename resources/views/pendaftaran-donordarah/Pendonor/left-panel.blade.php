<!-- Left Panel: Branding & Info (Soft Pink Gradient) -->
<div id="leftBrandingPanel" class="w-full lg:w-5/12 bg-gradient-to-br from-rose-100 via-pink-50 to-rose-50 p-8 lg:p-12 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-rose-100/60">
    <!-- Brand Header -->
    <div class="flex items-center space-x-3 mb-8 lg:mb-0">
        <div class="bg-white p-2.5 rounded-2xl shadow-md border border-rose-100/50 flex items-center justify-center">
            <!-- Blood Heart Icon -->
            <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <div>
            <div class="text-slate-800 font-extrabold text-sm tracking-wider uppercase leading-none">Pendaftaran Donor</div>
            <div class="text-rose-500 font-extrabold text-[10px] tracking-widest uppercase mt-1">Satu Tetes, Sejuta Harapan</div>
        </div>
    </div>

    <!-- Headline Section -->
    <div class="my-auto py-8">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-850 leading-tight mb-4">
            Bagikan Kehidupan,<br>Jadilah <span class="bg-rose-500/10 text-rose-600 px-3 py-1 rounded-2xl font-black inline-block shadow-sm">Pahlawan</span> Hari Ini.
        </h2>
        <p class="text-slate-600 text-sm leading-relaxed mb-8">
            Setiap tetesan darah yang Anda donorkan adalah kesempatan hidup baru bagi mereka yang membutuhkan. Daftarkan diri Anda sekarang untuk menjadi jembatan kebaikan.
        </p>
        
        <!-- Info Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="bg-white/90 backdrop-blur-sm p-4 rounded-2xl border border-rose-100/50 shadow-sm flex items-start space-x-3 hover:shadow-md transition duration-200">
                <div class="p-2 bg-rose-50 rounded-xl text-rose-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-slate-800">Proses Cepat</h4>
                    <p class="text-slate-550 text-[10px] mt-0.5 leading-relaxed">Daftar secara daring dalam 2 menit saja sebelum datang.</p>
                </div>
            </div>
            
            <div class="bg-white/90 backdrop-blur-sm p-4 rounded-2xl border border-rose-100/50 shadow-sm flex items-start space-x-3 hover:shadow-md transition duration-200">
                <div class="p-2 bg-rose-50 rounded-xl text-rose-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs text-slate-800">Riwayat Donor</h4>
                    <p class="text-slate-550 text-[10px] mt-0.5 leading-relaxed">Pantau jadwal dan riwayat donor dengan mudah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Branding -->
    <div class="text-left text-[10px] text-slate-400 font-medium pt-4 border-t border-rose-100/30">
        &copy; {{ date('Y') }} Layanan Donor Darah. All Rights Reserved.
    </div>
</div>
