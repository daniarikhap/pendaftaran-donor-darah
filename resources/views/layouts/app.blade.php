<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50">
        <div class="min-h-screen flex bg-slate-50">
            @include('pendaftaran-donordarah.Admin.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 relative bg-gradient-to-br from-slate-50 via-rose-50/10 to-slate-50">
                <!-- Subtle elegant pink/rose glowing background blobs -->
                <div class="absolute right-0 top-0 w-96 h-96 rounded-full bg-rose-500/[0.03] blur-[100px] pointer-events-none"></div>
                <div class="absolute left-1/3 bottom-0 w-96 h-96 rounded-full bg-pink-500/[0.03] blur-[120px] pointer-events-none"></div>

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow-sm border-b border-slate-200/80 min-h-[73px] flex items-center z-10">
                        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-3">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-6 z-10">
                    {{ $slot }}
                </main>
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
                            // If it's a verification or something else, show it
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
