<!-- SUB-TAB: PEGAWAI -->
<div id="sectionPegawai" class="space-y-6 hidden">
    <form id="formPegawai" class="space-y-5" novalidate>
        <!-- Search NIP -->
        <div class="space-y-1.5">
            <label for="pegawai_nip_search" class="block font-bold text-xs text-slate-700">Nomor Induk Pegawai (NIP) <span
                    class="text-rose-500 font-extrabold">*</span></label>
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
            <!-- Hidden inputs for mapping and backend verification -->
            <input type="hidden" name="jenisidentitas" value="KTP" />
            <input type="hidden" id="pegawai_pegawai_id" name="pegawai_id" />
            <input type="hidden" id="pegawai_pekerjaan_id" name="pekerjaan_id" />
            <input type="hidden" id="pegawai_agama" name="agama" />
            <input type="hidden" id="pegawai_statusperkawinan" name="statusperkawinan" />
            <input type="hidden" id="pegawai_gol_darah" name="gol_darah" />
            <input type="hidden" id="pegawai_rhesus" name="rhesus" />
            <input type="hidden" id="pegawai_jenis_kelamin" name="jenis_kelamin" />
            <input type="hidden" id="pegawai_propinsi_id" name="propinsi_id" />
            <input type="hidden" id="pegawai_kabupaten_id" name="kabupaten_id" />
            <input type="hidden" id="pegawai_kecamatan_id" name="kecamatan_id" />
            <input type="hidden" id="pegawai_kelurahan_id" name="kelurahan_id" />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Nama Lengkap</label>
                    <input id="pegawai_nama" type="text" name="nama_lengkap" readonly
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                </div>
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Nomor Identitas (NIK)</label>
                    <input id="pegawai_nik" type="text" name="no_identitas" readonly
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Tempat Lahir</label>
                    <input id="pegawai_tempat_lahir" type="text" name="tempat_lahir" readonly
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                </div>
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Tanggal Lahir</label>
                    <div class="relative">
                        <input id="pegawai_tgllahir" type="text" name="tgllahir" readonly
                            class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed"
                            placeholder="dd/mm/yyyy" />
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Jenis Kelamin</label>
                    <div id="pegawai_view_jk_container" class="flex gap-4 py-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="jenis_kelamin_pegawai" value="Laki-laki" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="jenis_kelamin_pegawai" value="Perempuan" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Agama</label>
                    <select id="pegawai_view_agama" class="select2-pegawai block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all">
                        <option value="">-- Pilih Agama --</option>
                        @foreach(['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGHUCU'] as $agama)
                            <option value="{{ $agama }}">{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Status Perkawinan</label>
                    <select id="pegawai_view_statusperkawinan" class="select2-pegawai block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all">
                        <option value="">-- Pilih Status --</option>
                        @foreach(['KAWIN', 'BELUM KAWIN', 'CERAI HIDUP', 'CERAI MATI'] as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Pekerjaan</label>
                    <input id="pegawai_pekerjaan" type="text" value="Pegawai Rumah Sakit" readonly
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Golongan Darah</label>
                    <select id="pegawai_view_gol_darah" class="select2-pegawai block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all">
                        <option value="">-- Pilih Golongan Darah --</option>
                        @foreach(['A', 'B', 'O', 'AB'] as $gd)
                            <option value="{{ $gd }}">{{ $gd }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block font-bold text-xs text-slate-700">Rhesus</label>
                    <div id="pegawai_view_rhesus_container" class="flex gap-4 py-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="rhesus_pegawai" value="Positif" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Positif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="rhesus_pegawai" value="Negatif" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Negatif</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Fields (Enabled once NIP verified) -->
        <div id="pegawaiManualFields" class="space-y-4 hidden">
            <div class="space-y-1.5">
                <label for="peg_alamat_lengkap" class="block font-bold text-xs text-slate-700">Alamat Lengkap <span
                        class="text-rose-500 font-extrabold">*</span></label>
                <textarea id="peg_alamat_lengkap" name="alamat_lengkap" rows="2" required readonly
                    class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed"
                    placeholder="Alamat Lengkap"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1.5">
                    <label for="peg_berat_badan" class="block font-bold text-xs text-slate-700">Berat Badan (Kg) <span
                            class="text-rose-500 font-extrabold">*</span></label>
                    <input id="peg_berat_badan" type="text" name="beratbadan_kg" required readonly
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed"
                        placeholder="Kg" />
                </div>
                <div class="space-y-1.5">
                    <label for="peg_tinggi_badan" class="block font-bold text-xs text-slate-700">Tinggi Badan (Cm)
                        <span class="text-rose-500 font-extrabold">*</span></label>
                    <input id="peg_tinggi_badan" type="text" name="tinggibadan_cm" required readonly
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed"
                        placeholder="Cm" />
                </div>
                <div class="space-y-1.5">
                    <label for="peg_no_mobile" class="block font-bold text-xs text-slate-700">No Mobile Aktif <span
                            class="text-rose-500 font-extrabold">*</span></label>
                    <input id="peg_no_mobile" type="text" name="no_mobile" required readonly
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="block w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-sm focus:outline-none text-slate-500 cursor-not-allowed"
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
