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
                    <label for="umum_jenisidentitas" class="block font-bold text-xs text-slate-700">Jenis Identitas <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_jenisidentitas" name="jenisidentitas" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">Pilih Salah Satu</option>
                        <option value="KTP">KTP</option>
                        <option value="SIM">SIM</option>
                        <option value="KARTU PELAJAR">KARTU PELAJAR</option>
                        <option value="KTA">KTA</option>
                        <option value="KITAS">KITAS</option>
                        <option value="PASPOR">PASPOR</option>
                        <option value="LAINNYA">LAINNYA</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="umum_no_identitas" class="block font-bold text-xs text-slate-700">No. Identitas <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_no_identitas" type="text" name="no_identitas" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                        placeholder="No Identitas" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="umum_nama_lengkap" class="block font-bold text-xs text-slate-700">Nama Lengkap <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_nama_lengkap" type="text" name="nama_lengkap" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                        placeholder="Nama Lengkap" />
                </div>
                <div class="space-y-1.5">
                    <label for="umum_tempat_lahir" class="block font-bold text-xs text-slate-700">Tempat Lahir <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_tempat_lahir" type="text" name="tempat_lahir" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                        placeholder="Masukkan Kota Lahir" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="umum_tgllahir" class="block font-bold text-xs text-slate-700">Tanggal Lahir <span class="text-rose-500 font-extrabold">*</span></label>
                    <div class="relative group">
                        <input id="umum_tgllahir" type="text" name="tgllahir" required
                            class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400"
                            placeholder="dd/mm/yyyy" />
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
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
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="umum_status_perkawinan" class="block font-bold text-xs text-slate-700">Status Perkawinan <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_status_perkawinan" name="statusperkawinan" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Status Perkawinan --</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="umum_gol_darah" class="block font-bold text-xs text-slate-700">Golongan Darah <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_gol_darah" name="gol_darah" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Golongan Darah --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Rhesus <span class="text-rose-500 font-extrabold">*</span></label>
                    <div class="flex items-center space-x-4 py-2">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="rhesus" value="Positif" required class="text-rose-600 focus:ring-rose-500">
                            <span class="ml-2 text-sm text-slate-700">Positif</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="rhesus" value="Negatif" required class="text-rose-600 focus:ring-rose-500">
                            <span class="ml-2 text-sm text-slate-700">Negatif</span>
                        </label>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label for="umum_tinggi_badan" class="block font-bold text-xs text-slate-700">Tinggi Badan (Cm) <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_tinggi_badan" type="text" name="tinggibadan_cm" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                        placeholder="Tinggi Badan" />
                </div>
                <div class="space-y-1.5">
                    <label for="umum_berat_badan" class="block font-bold text-xs text-slate-700">Berat Badan (Kg) <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_berat_badan" type="text" name="beratbadan_kg" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150"
                        placeholder="Berat Badan" />
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
                    <select id="umum_provinsi" name="propinsi_id" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinsis as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="umum_kabupaten" class="block font-bold text-xs text-slate-700">Kabupaten / Kota <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_kabupaten" name="kabupaten_id" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="umum_kecamatan" class="block font-bold text-xs text-slate-700">Kecamatan <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_kecamatan" name="kecamatan_id" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="umum_kelurahan" class="block font-bold text-xs text-slate-700">Kelurahan <span class="text-rose-500 font-extrabold">*</span></label>
                    <select id="umum_kelurahan" name="kelurahan_id" required
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer">
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                <div class="space-y-1.5">
                    <label for="umum_no_mobile" class="block font-bold text-xs text-slate-700">No Mobile Aktif <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="umum_no_mobile" type="text" name="no_mobile" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
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
