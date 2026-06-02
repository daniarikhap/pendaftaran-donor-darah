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
</head>
<body class="font-sans antialiased bg-gradient-to-tr from-rose-100/40 via-slate-100 to-pink-100/40 min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8">

    <!-- Main Container Card -->
    <div class="w-full max-w-6xl bg-white shadow-2xl rounded-3xl overflow-hidden flex flex-col lg:flex-row my-4 border border-rose-100/50">
        
        <!-- Left Panel: Branding & Info (Soft Pink Gradient) -->
        <div class="w-full lg:w-5/12 bg-gradient-to-br from-rose-100 via-pink-50 to-rose-50 p-8 lg:p-12 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-rose-100/60">
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

        <!-- Right Panel: Interactive Forms -->
        <div class="w-full lg:w-7/12 p-8 lg:p-12 flex flex-col justify-between bg-white">
            <div>
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-800">
                        Pendaftaran Donor Darah
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">Silakan verifikasi data diri Anda atau buat pendaftaran baru.</p>
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
                    <!-- TAB 1: PENDONOR LAMA -->
                    <div id="sectionLama" class="space-y-6">
                        <form id="formLama" class="space-y-5" novalidate>
                            <!-- Pilih Nomor KTP / Nomor Pendonor -->
                            <div class="space-y-1.5">
                                <label for="lama_jenis_identitas" class="block font-bold text-xs text-slate-700">Pilih Nomor KTP / Nomor Pendonor</label>
                                <select id="lama_jenis_identitas" name="jenis_identitas"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer text-sm">
                                    <option value="NIK">KTP / Nomor Pendonor</option>
                                    <option value="NIK_KTP">Nomor KTP (NIK)</option>
                                    <option value="NO_PENDONOR">Nomor Pendonor</option>
                                </select>
                            </div>

                            <!-- KTP / Nomor Pendonor Input -->
                            <div class="space-y-1.5">
                                <label id="lama_label_identitas" for="lama_identitas_value" class="block font-bold text-xs text-slate-700">KTP / Nomor Pendonor <span class="text-rose-500 font-extrabold">*</span></label>
                                <input id="lama_identitas_value" type="text" name="identitas_value" required
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                                    placeholder="KTP / Nomor Pendonor" />
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="space-y-1.5">
                                <label for="lama_tgllahir" class="block font-bold text-xs text-slate-700">Tanggal Lahir <span class="text-rose-500 font-extrabold">*</span></label>
                                <input id="lama_tgllahir" type="date" name="tgllahir" required
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm" />
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-start space-x-4 pt-4">
                                <button type="submit"
                                    class="bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md shadow-rose-500/10 hover:shadow-rose-500/20 active:scale-[0.98] transition duration-150 focus:outline-none text-sm">
                                    MASUK
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: PENDONOR BARU -->
                    <div id="sectionBaru" class="space-y-6 hidden">
                        <!-- Sub-Tabs (Pegawai vs Umum) -->
                        <div class="flex space-x-2 bg-slate-50 p-1 rounded-xl border border-slate-100 max-w-[240px]">
                            <button type="button" id="subTabPegawai" onclick="switchSubTab('pegawai')"
                                class="flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50">
                                Pegawai
                            </button>
                            <button type="button" id="subTabUmum" onclick="switchSubTab('umum')"
                                class="flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm">
                                Umum
                            </button>
                        </div>

                        <!-- SUB-TAB: UMUM -->
                        <div id="sectionUmum" class="space-y-6">
                            <!-- Stepper / Wizard Progress Bar -->
                            <div class="flex items-center justify-between w-full max-w-md mx-auto mb-8 relative px-2 select-none">
                                <!-- Step 1 -->
                                <div class="flex items-center space-x-2.5 cursor-pointer z-10" onclick="goToStep(1)">
                                    <div id="stepCircle1" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300">
                                        1
                                    </div>
                                    <span id="stepLabel1" class="text-sm font-bold text-slate-800 transition-all duration-300">Data Pribadi</span>
                                </div>
                                
                                <!-- Connecting line -->
                                <div class="flex-1 mx-4 h-0.5 bg-slate-200 relative z-0">
                                    <div id="stepProgressLine" class="absolute top-0 left-0 h-full w-0 bg-gradient-to-r from-rose-500 to-pink-600 transition-all duration-300"></div>
                                </div>
                                
                                <!-- Step 2 -->
                                <div id="stepTrigger2" class="flex items-center space-x-2.5 pointer-events-none opacity-50 z-10" onclick="goToStep(2)">
                                    <div id="stepCircle2" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-white text-slate-400 border-2 border-slate-200 transition-all duration-300">
                                        2
                                    </div>
                                    <span id="stepLabel2" class="text-sm font-bold text-slate-400 transition-all duration-300">Alamat dan Kontak</span>
                                </div>
                            </div>

                            <form id="formUmum" class="space-y-5" novalidate>
                                <!-- Data Pribadi Fields -->
                                <div id="divPribadi" class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_no_identitas" class="block font-bold text-xs text-slate-700">No. Identitas <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_no_identitas" type="text" name="no_identitas" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="No Identitas" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_nama_lengkap" class="block font-bold text-xs text-slate-700">Nama Lengkap <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_nama_lengkap" type="text" name="nama_lengkap" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Nama Lengkap" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_tempat_lahir" class="block font-bold text-xs text-slate-700">Tempat Lahir <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_tempat_lahir" type="text" name="tempat_lahir" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Masukkan Kota Lahir" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_tgllahir" class="block font-bold text-xs text-slate-700">Tanggal Lahir <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_tgllahir" type="date" name="tgllahir" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Jenis Kelamin <span class="text-rose-500 font-extrabold">*</span></label>
                                            <div class="flex items-center space-x-4 py-2">
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" required class="text-rose-600 focus:ring-rose-500">
                                                    <span class="ml-2 text-sm text-slate-700">Laki-laki</span>
                                                </label>
                                                <label class="inline-flex items-center cursor-pointer">
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" required class="text-rose-600 focus:ring-rose-500">
                                                    <span class="ml-2 text-sm text-slate-700">Perempuan</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_pekerjaan_id" class="block font-bold text-xs text-slate-700">Pekerjaan <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_pekerjaan_id" name="pekerjaan_id" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Pekerjaan --</option>
                                                @foreach ($pekerjaans as $p)
                                                    <option value="{{ $p->pekerjaan_id }}">{{ $p->pekerjaan_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_agama" class="block font-bold text-xs text-slate-700">Agama <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_agama" name="agama" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Protestan">Kristen Protestan</option>
                                                <option value="Katolik">Kristen Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Khonghucu">Khonghucu</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_status_perkawinan" class="block font-bold text-xs text-slate-700">Status Perkawinan <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_status_perkawinan" name="status_perkawinan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Belum Kawin --</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat dan Kontak Fields -->
                                <div id="divAlamat" class="space-y-4 hidden">
                                    <div class="space-y-1.5">
                                        <label for="umum_alamat_lengkap" class="block font-bold text-xs text-slate-700">Alamat Lengkap Pendonor <span class="text-rose-500 font-extrabold">*</span></label>
                                        <textarea id="umum_alamat_lengkap" name="alamat_lengkap" rows="2" required
                                            class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                            placeholder="Alamat Lengkap"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_provinsi" class="block font-bold text-xs text-slate-700">Provinsi <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_provinsi" name="provinsi" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Provinsi --</option>
                                                <option value="Jawa Timur">Jawa Timur</option>
                                                <option value="Jawa Tengah">Jawa Tengah</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_kabupaten" class="block font-bold text-xs text-slate-700">Kabupaten / Kota <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_kabupaten" name="kabupaten" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Kota --</option>
                                                <option value="Surabaya">Surabaya</option>
                                                <option value="Sidoarjo">Sidoarjo</option>
                                                <option value="Gresik">Gresik</option>
                                                <option value="Malang">Malang</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_kecamatan" class="block font-bold text-xs text-slate-700">Kecamatan <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_kecamatan" name="kecamatan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Kecamatan --</option>
                                                <option value="Gubeng">Gubeng</option>
                                                <option value="Wonokromo">Wonokromo</option>
                                                <option value="Sukolilo">Sukolilo</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_kelurahan" class="block font-bold text-xs text-slate-700">Kelurahan <span class="text-rose-500 font-extrabold">*</span></label>
                                            <select id="umum_kelurahan" name="kelurahan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                                                <option value="">-- Pilih Kelurahan --</option>
                                                <option value="Airlangga">Airlangga</option>
                                                <option value="Pucang Sewu">Pucang Sewu</option>
                                                <option value="Gubeng">Gubeng</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="umum_berat_badan" class="block font-bold text-xs text-slate-700">Berat Badan (Kg) <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_berat_badan" type="number" name="berat_badan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Berat Badan" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_tinggi_badan" class="block font-bold text-xs text-slate-700">Tinggi Badan (Cm) <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_tinggi_badan" type="number" name="tinggi_badan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Tinggi Badan" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="umum_no_mobile" class="block font-bold text-xs text-slate-700">No Mobile Aktif <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="umum_no_mobile" type="text" name="no_mobile" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="0812XXXXXXXX" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-start space-x-4 pt-4">
                                    <button type="button" id="btnBackUmum" onclick="handleBackUmum()"
                                        class="bg-rose-50 hover:bg-rose-100 active:bg-rose-200 text-rose-700 font-bold py-2.5 px-8 rounded-xl transition duration-150 focus:outline-none text-sm border border-rose-100">
                                        KEMBALI
                                    </button>
                                    <button type="button" id="btnNextUmum" onclick="goToStep(2)" disabled
                                        class="bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm">
                                        LANJUT
                                    </button>
                                    <button type="submit" id="btnSubmitUmum" disabled
                                        class="hidden bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm">
                                        DAFTAR PENDONOR BARU
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- SUB-TAB: PEGAWAI -->
                        <div id="sectionPegawai" class="space-y-6 hidden">
                            <form id="formPegawai" class="space-y-5" novalidate>
                                <!-- Search NIP -->
                                <div class="space-y-1.5">
                                    <label for="pegawai_nip_search" class="block font-bold text-xs text-slate-700">Nomor Induk Pegawai (NIP) <span class="text-rose-500 font-extrabold">*</span></label>
                                    <div class="flex space-x-2">
                                        <input id="pegawai_nip_search" type="text" name="nip_search" required
                                            class="flex-1 px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                            placeholder="Masukkan NIP Anda (Contoh: 12345678)" />
                                        <button type="button" onclick="searchNipPegawai()"
                                            class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition duration-150 focus:outline-none active:scale-[0.97]">
                                            CARI DATA
                                        </button>
                                    </div>
                                </div>

                                <!-- Autocompleted / Auto-fill Fields -->
                                <div id="pegawaiAutoFields" class="space-y-4 opacity-50 pointer-events-none">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Nama Lengkap</label>
                                            <input id="pegawai_nama" type="text" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Nomor Identitas (NIK)</label>
                                            <input id="pegawai_nik" type="text" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Tempat Lahir</label>
                                            <input id="pegawai_tempat_lahir" type="text" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Tanggal Lahir</label>
                                            <input id="pegawai_tgllahir" type="date" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Jenis Kelamin</label>
                                            <input id="pegawai_jenis_kelamin" type="text" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block font-bold text-xs text-slate-700">Pekerjaan</label>
                                            <input id="pegawai_pekerjaan" type="text" value="Pegawai Rumah Sakit" readonly
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Manual Fields (Enabled once NIP verified) -->
                                <div id="pegawaiManualFields" class="space-y-4 hidden">
                                    <div class="space-y-1.5">
                                        <label for="peg_alamat_lengkap" class="block font-bold text-xs text-slate-700">Alamat Lengkap <span class="text-rose-500 font-extrabold">*</span></label>
                                        <textarea id="peg_alamat_lengkap" name="alamat_lengkap" rows="2" required
                                            class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                            placeholder="Alamat Lengkap"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div class="space-y-1.5">
                                            <label for="peg_berat_badan" class="block font-bold text-xs text-slate-700">Berat Badan (Kg) <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="peg_berat_badan" type="number" name="berat_badan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Kg" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="peg_tinggi_badan" class="block font-bold text-xs text-slate-700">Tinggi Badan (Cm) <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="peg_tinggi_badan" type="number" name="tinggi_badan" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="Cm" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label for="peg_no_mobile" class="block font-bold text-xs text-slate-700">No Mobile Aktif <span class="text-rose-500 font-extrabold">*</span></label>
                                            <input id="peg_no_mobile" type="text" name="no_mobile" required
                                                class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                                                placeholder="0812XXXXXXXX" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-start space-x-4 pt-4">
                                    <button type="button" onclick="switchMainTab('lama')"
                                        class="bg-rose-50 hover:bg-rose-100 active:bg-rose-200 text-rose-700 font-bold py-2.5 px-8 rounded-xl transition duration-150 focus:outline-none text-sm border border-rose-100">
                                        KEMBALI
                                    </button>
                                    <button type="submit" id="btnSubmitPegawai" disabled
                                        class="bg-rose-300 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-50 cursor-not-allowed transition duration-150 focus:outline-none text-sm">
                                        DAFTAR PENDONOR BARU
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Officer Link -->
            <div class="text-center lg:text-left pt-6 border-t border-slate-100 mt-8">
                <p class="text-sm text-slate-500">
                    Hubungi Petugas? 
                    <a href="{{ route('login') }}" class="font-bold text-rose-600 hover:text-rose-500 transition duration-150">
                        Masuk Ke Akun Petugas &rarr;
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript logic -->
    <script>
        const existingDonors = @json($pendonors);
        // Mock lookup database for pegawai list to simulate auto-fill (NIP: 12345678 as seeded)
        const mockPegawaiList = [
            {
                nip: '12345678',
                nama: 'Admin',
                nik: '3201234567890005',
                tempat_lahir: 'Surabaya',
                tgllahir: '1988-11-20',
                jenis_kelamin: 'Laki-laki'
            }
        ];

        // 1. Main Tab Switch (Lama vs Baru)
        function switchMainTab(tab) {
            const tabLama = document.getElementById('tabLama');
            const tabBaru = document.getElementById('tabBaru');
            const secLama = document.getElementById('sectionLama');
            const secBaru = document.getElementById('sectionBaru');

            if (tab === 'lama') {
                tabLama.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md shadow-rose-500/20";
                tabBaru.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
                secLama.classList.remove('hidden');
                secBaru.classList.add('hidden');
            } else {
                tabBaru.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-md shadow-rose-500/20";
                tabLama.className = "py-2.5 px-6 text-sm font-bold rounded-xl transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
                secBaru.classList.remove('hidden');
                secLama.classList.add('hidden');
            }
        }

        // 2. Sub-Tab Switch (Pegawai vs Umum)
        function switchSubTab(sub) {
            const tabPegawai = document.getElementById('subTabPegawai');
            const tabUmum = document.getElementById('subTabUmum');
            const secPegawai = document.getElementById('sectionPegawai');
            const secUmum = document.getElementById('sectionUmum');

            if (sub === 'pegawai') {
                tabPegawai.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm";
                tabUmum.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
                secPegawai.classList.remove('hidden');
                secUmum.classList.add('hidden');
            } else {
                tabUmum.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm";
                tabPegawai.className = "flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50";
                secUmum.classList.remove('hidden');
                secPegawai.classList.add('hidden');
            }
        }

        // 3. Wizard / Stepper Navigation for "Umum"
        let currentStepUmum = 1;
        let isStep1Valid = false;
        let isStep2Valid = false;

        function checkStep1Validity() {
            const noIdentitas = document.getElementById('umum_no_identitas').value.trim();
            const namaLengkap = document.getElementById('umum_nama_lengkap').value.trim();
            const tempatLahir = document.getElementById('umum_tempat_lahir').value.trim();
            const tglLahir = document.getElementById('umum_tgllahir').value;
            const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            const pekerjaan = document.getElementById('umum_pekerjaan_id').value;
            const agama = document.getElementById('umum_agama').value;
            const statusPerkawinan = document.getElementById('umum_status_perkawinan').value;

            isStep1Valid = noIdentitas && namaLengkap && tempatLahir && tglLahir && jenisKelamin && pekerjaan && agama && statusPerkawinan;

            const btnNext = document.getElementById('btnNextUmum');
            const stepTrigger2 = document.getElementById('stepTrigger2');

            if (isStep1Valid) {
                btnNext.disabled = false;
                btnNext.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";
                stepTrigger2.classList.remove('pointer-events-none', 'opacity-50');
            } else {
                btnNext.disabled = true;
                btnNext.className = "bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
                stepTrigger2.classList.add('pointer-events-none', 'opacity-50');
            }
        }

        function checkStep2Validity() {
            const alamat = document.getElementById('umum_alamat_lengkap').value.trim();
            const provinsi = document.getElementById('umum_provinsi').value;
            const kabupaten = document.getElementById('umum_kabupaten').value;
            const kecamatan = document.getElementById('umum_kecamatan').value;
            const kelurahan = document.getElementById('umum_kelurahan').value;
            const beratBadan = document.getElementById('umum_berat_badan').value;
            const tinggiBadan = document.getElementById('umum_tinggi_badan').value;
            const noMobile = document.getElementById('umum_no_mobile').value.trim();

            isStep2Valid = alamat && provinsi && kabupaten && kecamatan && kelurahan && beratBadan && tinggiBadan && noMobile;

            const btnSubmit = document.getElementById('btnSubmitUmum');

            if (isStep2Valid) {
                btnSubmit.disabled = false;
                btnSubmit.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";
            } else {
                btnSubmit.disabled = true;
                btnSubmit.className = "bg-rose-200 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-60 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
            }
        }

        function setupValidationListeners() {
            const step1Inputs = [
                'umum_no_identitas', 'umum_nama_lengkap', 'umum_tempat_lahir', 'umum_tgllahir',
                'umum_pekerjaan_id', 'umum_agama', 'umum_status_perkawinan'
            ];
            step1Inputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', checkStep1Validity);
                    el.addEventListener('change', checkStep1Validity);
                }
            });

            document.querySelectorAll('input[name="jenis_kelamin"]').forEach(radio => {
                radio.addEventListener('change', checkStep1Validity);
            });

            const step2Inputs = [
                'umum_alamat_lengkap', 'umum_provinsi', 'umum_kabupaten', 'umum_kecamatan',
                'umum_kelurahan', 'umum_berat_badan', 'umum_tinggi_badan', 'umum_no_mobile'
            ];
            step2Inputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', checkStep2Validity);
                    el.addEventListener('change', checkStep2Validity);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', setupValidationListeners);

        function goToStep(step) {
            if (step === 2 && !isStep1Valid) return;

            currentStepUmum = step;
            const divPribadi = document.getElementById('divPribadi');
            const divAlamat = document.getElementById('divAlamat');
            const stepCircle1 = document.getElementById('stepCircle1');
            const stepCircle2 = document.getElementById('stepCircle2');
            const stepLabel1 = document.getElementById('stepLabel1');
            const stepLabel2 = document.getElementById('stepLabel2');
            const stepProgressLine = document.getElementById('stepProgressLine');
            const btnNext = document.getElementById('btnNextUmum');
            const btnSubmit = document.getElementById('btnSubmitUmum');

            if (step === 1) {
                divPribadi.classList.remove('hidden');
                divAlamat.classList.add('hidden');
                
                stepCircle1.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
                stepLabel1.className = "text-sm font-bold text-slate-800 transition-all duration-300";
                
                stepCircle2.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-white text-slate-400 border-2 border-slate-200 transition-all duration-300";
                stepLabel2.className = "text-sm font-bold text-slate-400 transition-all duration-300";
                
                stepProgressLine.style.width = "0%";
                
                btnNext.classList.remove('hidden');
                btnSubmit.classList.add('hidden');
            } else {
                divPribadi.classList.add('hidden');
                divAlamat.classList.remove('hidden');
                
                stepCircle1.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
                stepLabel1.className = "text-sm font-bold text-slate-800 transition-all duration-300";
                
                stepCircle2.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-rose-600 text-white shadow-md transition-all duration-300";
                stepLabel2.className = "text-sm font-bold text-slate-850 transition-all duration-300";
                
                stepProgressLine.style.width = "100%";
                
                btnNext.classList.add('hidden');
                btnSubmit.classList.remove('hidden');
                
                checkStep2Validity();
            }
        }

        function handleBackUmum() {
            if (currentStepUmum === 2) {
                goToStep(1);
            } else {
                switchMainTab('lama');
            }
        }

        // 4. Input Label modifier for Lama Identitas selector
        document.getElementById('lama_jenis_identitas').addEventListener('change', function() {
            const label = document.getElementById('lama_label_identitas');
            const input = document.getElementById('lama_identitas_value');
            if (this.value === 'NIK_KTP') {
                label.innerHTML = 'Nomor KTP (NIK) <span class="text-rose-500 font-extrabold">*</span>';
                input.placeholder = 'Nomor KTP (NIK)';
            } else if (this.value === 'NO_PENDONOR') {
                label.innerHTML = 'Nomor Pendonor <span class="text-rose-500 font-extrabold">*</span>';
                input.placeholder = 'Nomor Pendonor';
            } else {
                label.innerHTML = 'KTP / Nomor Pendonor <span class="text-rose-500 font-extrabold">*</span>';
                input.placeholder = 'KTP / Nomor Pendonor';
            }
        });

        // 5. Reset forms helper
        function resetForm(formId) {
            document.getElementById(formId).reset();
            const inputs = document.getElementById(formId).querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.remove('border-red-500', 'focus:ring-red-500/20');
                input.classList.add('border-slate-200');
            });
            if (formId === 'formPegawai') {
                document.getElementById('pegawaiAutoFields').classList.add('opacity-50', 'pointer-events-none');
                document.getElementById('pegawaiManualFields').classList.add('hidden');
                const submitBtn = document.getElementById('btnSubmitPegawai');
                submitBtn.disabled = true;
                submitBtn.className = "bg-rose-300 text-white font-bold py-2.5 px-8 rounded-xl shadow opacity-50 cursor-not-allowed transition duration-150 focus:outline-none text-sm";
            }
            if (formId === 'formUmum') {
                goToStep(1);
                isStep1Valid = false;
                isStep2Valid = false;
                checkStep1Validity();
            }
        }

        // 6. Generic Validate fields
        function validateFields(formId) {
            let isValid = true;
            const form = document.getElementById(formId);
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (field.type === 'radio') {
                    // Check if radio group has checked value
                    const name = field.name;
                    const checked = form.querySelector(`input[name="${name}"]:checked`);
                    if (!checked) {
                        isValid = false;
                        const parent = field.closest('.space-y-1.5');
                        parent.classList.add('border-red-500');
                    }
                } else if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500', 'focus:ring-red-500/20');
                    field.classList.remove('border-slate-200');
                } else {
                    field.classList.remove('border-red-500');
                    field.classList.add('border-slate-200');
                }
            });

            return isValid;
        }

        // 7. Search NIP logic
        function searchNipPegawai() {
            const nipVal = document.getElementById('pegawai_nip_search').value.trim();
            if (!nipVal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Masukkan NIP Pegawai terlebih dahulu.'
                });
                return;
            }

            const matchedPegawai = mockPegawaiList.find(peg => peg.nip === nipVal);

            if (matchedPegawai) {
                // Auto-fill values
                document.getElementById('pegawai_nama').value = matchedPegawai.nama;
                document.getElementById('pegawai_nik').value = matchedPegawai.nik;
                document.getElementById('pegawai_tempat_lahir').value = matchedPegawai.tempat_lahir;
                document.getElementById('pegawai_tgllahir').value = matchedPegawai.tgllahir;
                document.getElementById('pegawai_jenis_kelamin').value = matchedPegawai.jenis_kelamin;

                // Unlock manual inputs
                document.getElementById('pegawaiAutoFields').classList.remove('opacity-50', 'pointer-events-none');
                document.getElementById('pegawaiManualFields').classList.remove('hidden');

                // Enable submit button
                const submitBtn = document.getElementById('btnSubmitPegawai');
                submitBtn.disabled = false;
                submitBtn.className = "bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm";

                Swal.fire({
                    icon: 'success',
                    title: 'Pegawai Ditemukan',
                    text: `Data Pegawai atas nama ${matchedPegawai.nama} berhasil dimuat!`
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Ditemukan',
                    text: 'Nomor Induk Pegawai (NIP) tidak terdaftar.'
                });
            }
        }

        // 8. Submit Forms validation & messages
        document.getElementById('formLama').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateFields('formLama')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Lengkap',
                    text: 'Silakan isi semua kolom bertanda bintang/wajib.'
                });
                return;
            }

            const identitasVal = document.getElementById('lama_identitas_value').value;
            const tglLahirVal = document.getElementById('lama_tgllahir').value;

            const matchedDonor = existingDonors.find(donor => {
                const idMatch = donor.no_identitas === identitasVal || donor.no_pendonor === identitasVal;
                const dbDate = new Date(donor.tgllahir).toISOString().split('T')[0];
                return idMatch && dbDate === tglLahirVal;
            });

            if (matchedDonor) {
                Swal.fire({
                    icon: 'success',
                    title: 'Verifikasi Berhasil!',
                    text: `Selamat datang kembali, ${matchedDonor.nama_lengkap}. Anda dapat melanjutkan proses.`
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Masuk',
                    text: 'KTP/Nomor Pendonor atau Tanggal Lahir tidak cocok.'
                });
            }
        });

        document.getElementById('formUmum').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateFields('formUmum')) {
                // If invalid, verify if data is in section 2 and switch to show user
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Silakan lengkapi semua bidang yang ditandai bintang merah pada tab Data Pribadi & Alamat.'
                });
                return;
            }

            const nama = document.getElementById('umum_nama_lengkap').value;
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: `Pendonor Baru atas nama ${nama} berhasil terdaftar!`
            }).then(() => {
                resetForm('formUmum');
                switchMainTab('lama');
            });
        });

        document.getElementById('formPegawai').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateFields('formPegawai')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Lengkapi seluruh data alamat dan kontak untuk Pegawai.'
                });
                return;
            }

            const nama = document.getElementById('pegawai_nama').value;
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Pegawai Berhasil',
                text: `Pegawai atas nama ${nama} berhasil terdaftar sebagai pendonor.`
            }).then(() => {
                resetForm('formPegawai');
                switchMainTab('lama');
            });
        });
    </script>
</body>
</html>
