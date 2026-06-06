<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pendaftaran Donor Darah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery and Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Flatpickr (Date Range Picker) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        /* Select2 Premium Custom Styling to match Tailwind forms */
        .select2-container--default .select2-selection--single {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            height: 42px !important;
            background-color: rgba(248, 250, 252, 0.5) !important;
            display: flex;
            align-items: center;
            transition: all 150ms ease-in-out;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #f43f5e !important;
            box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.2) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #0f172a !important;
            font-size: 0.875rem !important;
            padding-left: 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 8px !important;
        }

        .select2-dropdown {
            border: 1px solid #f1f5f9 !important;
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden;
            z-index: 9999;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #e11d48 !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            padding: 6px 10px !important;
            outline: none !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: #f43f5e !important;
            box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.2) !important;
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: none !important;
        }
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        table.dataTable border-b {
            border-bottom: 1px solid rgb(241, 245, 249) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #e11d48 !important;
            color: white !important;
            border: 1px solid #e11d48 !important;
            border-radius: 8px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #fda4af !important;
            color: #9f1239 !important;
            border: 1px solid #fda4af !important;
            border-radius: 8px !important;
        }

        /* Flatpickr Premium Custom Styling */
        .flatpickr-calendar {
            border-radius: 1.25rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            border: 1px solid #f1f5f9 !important;
            padding: 0.5rem;
            width: 300px !important;
        }

        .flatpickr-innerContainer {
            width: 100% !important;
        }

        .flatpickr-rContainer {
            width: 100% !important;
        }

        .flatpickr-days {
            width: 100% !important;
            display: flex;
            justify-content: center;
        }

        .dayContainer {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }

        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, 
        .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, 
        .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, 
        .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, 
        .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, 
        .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: #fff !important;
            border-radius: 50% !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            font-weight: 700 !important;
            color: #1e293b !important;
        }

        .flatpickr-day.today {
            border-color: #3b82f6 !important;
            color: #3b82f6 !important;
        }
    </style>
</head>

<body
    class="font-sans antialiased bg-gradient-to-tr from-rose-100/40 via-slate-100 to-pink-100/40 min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8">

    <!-- Main Container Card -->
    <div id="mainContentCard"
        class="w-full max-w-6xl bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col lg:flex-row my-4 border border-rose-100/50">

        <!-- Left Panel: Branding & Info -->
        @include('pendaftaran-donordarah.Pendonor.left-panel')

        <!-- Right Panel: Interactive Forms -->
        <div id="rightFormPanel" class="w-full lg:w-7/12 p-8 lg:p-12 flex flex-col justify-between bg-white">
            <div id="welcomeFormContainer" class="flex flex-col justify-between h-full">
                <div>
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-extrabold tracking-tight text-slate-800">
                            Pendaftaran Donor Darah
                        </h1>
                        <p class="text-sm text-slate-550 mt-1">Silakan verifikasi data diri Anda atau buat pendaftaran baru.
                        </p>
                    </div>

                    <!-- Main Tabs (Lama vs Baru) -->
                    <div class="flex space-x-3 mb-6 border-b border-slate-100 pb-4">
                        <button type="button" id="tabLama" onclick="switchMainTab('lama')"
                            class="py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md shadow-rose-500/20">
                            PENDONOR LAMA
                        </button>
                        <button type="button" id="tabBaru" onclick="switchMainTab('baru')"
                            class="py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50">
                            PENDONOR BARU
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div>
                        @include('pendaftaran-donordarah.Pendonor.lama')
                        @include('pendaftaran-donordarah.Pendonor.baru')
                    </div>
                </div>

                <!-- Officer Link -->
                <div class="text-center lg:text-left pt-6 border-t border-slate-100 mt-8">
                    <p class="text-sm text-slate-500">
                        Hubungi Petugas?
                        <a href="{{ route('login') }}"
                            class="font-bold text-rose-600 hover:text-rose-500 transition duration-150">
                            Masuk Ke Akun Petugas &rarr;
                        </a>
                    </p>
                </div>
            </div>

            @include('pendaftaran-donordarah.Pendonor.profil')
        </div>
    </div>

    @include('pendaftaran-donordarah.Pendonor.pendaftaran')

    <!-- VERIFY PEGAWAI MODAL -->
    <div id="verifyPegawaiModal" class="hidden fixed inset-0 z-[1050] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition duration-150">
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden animate-scale-up">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-rose-500 to-pink-600 p-6 text-white flex justify-between items-center">
                <h3 class="font-extrabold text-lg">Verifikasi Akun Pegawai</h3>
                <button type="button" onclick="closeVerifyPegawaiModal()" class="text-white/80 hover:text-white transition duration-150 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="formVerifyPegawai" class="p-6 space-y-4" novalidate>
                <!-- NIP Input -->
                <div class="space-y-1.5">
                    <label for="verify_nomorindukpegawai" class="block font-bold text-xs text-slate-700">Nomor Induk Pegawai (NIP) <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="verify_nomorindukpegawai" type="text" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                        placeholder="Nomor Induk Pegawai (NIP)" />
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label for="verify_password" class="block font-bold text-xs text-slate-700">Password <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="verify_password" type="password" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                        placeholder="Password" />
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeVerifyPegawaiModal()"
                        class="py-2.5 px-5 text-sm font-bold rounded-xl border border-slate-200 text-slate-650 hover:bg-slate-50 transition duration-150 focus:outline-none">
                        BATAL
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm">
                        VERIFIKASI
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pass backend variables to external javascript -->
    <script>
        const existingDonors = @json($pendonors);
    </script>

    <!-- JavaScript logic -->
    <script src="{{ asset('js/pendaftaran-donor.js') }}"></script>
</body>

</html>
