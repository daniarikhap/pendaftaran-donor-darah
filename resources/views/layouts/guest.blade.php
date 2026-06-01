<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pendaftaran Donor Darah') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 h-full">
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Pane: Elegant Light Blood Donation Info (Vibrant Red-to-Pink Theme) -->
            <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-gradient-to-br from-rose-100 via-rose-50/80 to-red-100/70 text-slate-800 p-12 lg:p-20 flex-col justify-between relative overflow-hidden border-r border-rose-100/80">
                <!-- Abstract glowing blobs with enhanced red-to-pink opacity -->
                <div class="absolute -left-20 -bottom-20 w-[420px] h-[420px] rounded-full bg-red-400/20 blur-[100px] pointer-events-none"></div>
                <div class="absolute -right-20 -top-20 w-[420px] h-[420px] rounded-full bg-pink-400/25 blur-[100px] pointer-events-none"></div>
                <div class="absolute left-1/3 top-1/4 w-[250px] h-[250px] rounded-full bg-rose-300/15 blur-[80px] pointer-events-none"></div>

                <!-- Top Header: Branding -->
                <div class="flex items-center space-x-3.5 z-10">
                    <div class="bg-white p-2.5 rounded-2xl border border-rose-200/80 shadow-md shadow-rose-100/20">
                        <x-application-logo class="w-10 h-10" />
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-wider uppercase block text-slate-800">
                            {{ config('app.name', 'DONOR DARAH') }}
                        </span>
                        <span class="text-[10px] text-rose-600 font-bold tracking-widest uppercase block -mt-1">
                            Satu Tetes, Sejuta Harapan
                        </span>
                    </div>
                </div>

                <!-- Center Content: Hero Text & Message -->
                <div class="my-auto z-10 max-w-xl pr-6">
                    <h1 class="text-4xl lg:text-5xl font-black tracking-tight leading-normal mb-6 text-slate-900">
                        Bagikan Kehidupan,<br/>
                        Jadilah <span class="inline-block text-rose-700 bg-rose-200/60 px-3 py-0.5 rounded-xl border border-rose-200 shadow-sm">Pahlawan</span> Hari Ini.
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed mb-8 font-normal">
                        Setiap tetesan darah yang Anda donorkan adalah kesempatan hidup baru bagi mereka yang membutuhkan. Daftarkan diri Anda sekarang untuk menjadi jembatan kebaikan.
                    </p>
                    
                    <!-- Micro Info Cards with beautiful red/pink tinted design -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                        <div class="bg-white/80 p-4 rounded-2xl border border-rose-100/80 shadow-sm hover:shadow-md hover:border-rose-200 transition duration-300 backdrop-blur-sm">
                            <div class="flex items-center space-x-3">
                                <div class="bg-rose-50 p-2 rounded-lg text-rose-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm text-slate-800">Proses Cepat</h3>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">Daftar secara daring dalam 2 menit saja sebelum datang ke lokasi.</p>
                        </div>
                        <div class="bg-white/80 p-4 rounded-2xl border border-rose-100/80 shadow-sm hover:shadow-md hover:border-rose-200 transition duration-300 backdrop-blur-sm">
                            <div class="flex items-center space-x-3">
                                <div class="bg-rose-50 p-2 rounded-lg text-rose-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-sm text-slate-800">Riwayat Donor</h3>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">Pantau jadwal dan riwayat donor darah Anda dengan mudah dan praktis.</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="z-10 text-xs text-slate-400 flex justify-between items-center border-t border-rose-100/80 pt-6 mt-8">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Donor Darah') }}. Semua Hak Dilindungi.</p>
                    <p class="flex items-center text-slate-500 font-medium">
                        <svg class="w-3.5 h-3.5 mr-1 text-rose-600 fill-current animate-pulse" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        Misi Kemanusiaan
                    </p>
                </div>
            </div>

            <!-- Right Pane: Authentication Form (Full width on mobile) -->
            <div class="w-full md:w-1/2 lg:w-2/5 flex flex-col justify-center items-center p-8 sm:p-12 md:p-16 bg-white transition-colors duration-300 relative min-h-screen">
                <!-- Soft glow decoration in the background -->
                <div class="absolute right-0 top-0 w-64 h-64 rounded-full bg-rose-500/5 blur-[80px] pointer-events-none"></div>
                
                <div class="w-full max-w-md z-10">
                    <!-- Brand / Logo for Mobile view (Hidden on desktop) -->
                    <div class="flex flex-col items-center mb-8 md:hidden">
                        <div class="bg-rose-50 p-4 rounded-3xl border border-rose-100 mb-3 shadow-md">
                            <x-application-logo class="w-12 h-12" />
                        </div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-800 uppercase">
                            {{ config('app.name', 'Donor Darah') }}
                        </h2>
                        <span class="text-xs text-slate-500 font-medium tracking-wide">Pendaftaran Donor Darah</span>
                    </div>

                    <!-- Inner Slot (Login, Register, Reset password, etc.) -->
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- SweetAlert2 Session Notifications -->
        @if (session('status') || session('success') || session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        customClass: {
                            popup: 'colored-toast rounded-xl shadow-lg border border-slate-100',
                            title: 'font-semibold text-slate-800 text-sm'
                        },
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    @if (session('status'))
                        let status = "{{ session('status') }}";
                        let message = status;
                        let icon = 'success';
                        
                        if (status === 'profile-updated') {
                            message = "Data pegawai berhasil disimpan!";
                        } else if (status === 'password-updated') {
                            message = "Password berhasil diperbarui!";
                        } else {
                            icon = 'info';
                        }
                        
                        Toast.fire({
                            icon: icon,
                            title: message
                        });
                    @endif

                    @if (session('success'))
                        Toast.fire({
                            icon: 'success',
                            title: "{{ session('success') }}"
                        });
                    @endif

                    @if (session('error'))
                        Toast.fire({
                            icon: 'error',
                            title: "{{ session('error') }}"
                        });
                    @endif
                });
            </script>
        @endif
    </body>
</html>
