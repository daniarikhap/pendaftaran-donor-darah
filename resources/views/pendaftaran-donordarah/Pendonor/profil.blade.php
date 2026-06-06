<!-- PROFILE CONTAINER (Hidden by default) -->
<div id="profileContainer" class="hidden w-full space-y-8 animate-fade-in">
    <!-- Header -->
    <div class="flex justify-between items-center border-b border-slate-100 pb-4">
        <h2 class="text-xl font-extrabold text-slate-800">Profil Pendonor</h2>
        <button type="button" id="btnKeluarProfile"
            class="flex items-center space-x-2 px-4 py-2 rounded-xl text-sm font-bold text-rose-600 border border-rose-200 bg-rose-50/30 hover:bg-rose-50 hover:border-rose-300 transition duration-150 shadow-sm focus:outline-none">
            <!-- Logout Icon -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>Keluar</span>
        </button>
    </div>

    <!-- Profile Details Card -->
    <div
        class="relative flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6 bg-gradient-to-br from-emerald-50 to-green-100/50 p-6 rounded-2xl border border-emerald-200/80 shadow-sm">
        <!-- Avatar -->
        <div
            class="relative w-24 h-24 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 overflow-hidden">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>

        <!-- Name & ID -->
        <div class="flex-1 text-center sm:text-left space-y-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-center sm:justify-start sm:space-x-4">
                <h3 id="profileName" class="text-lg font-black text-slate-800"></h3>
                <!-- Blood Type Badge (New) -->
                <div id="bloodBadge" class="hidden items-center space-x-2 bg-rose-50 px-3 py-1 rounded-xl border border-rose-100 mt-2 sm:mt-0 self-center sm:self-auto">
                    <svg class="w-3.5 h-3.5 text-rose-500 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2.152C12 2.152 4 11 4 16a8 8 0 1 0 16 0c0-5-8-13.848-8-13.848z"/>
                    </svg>
                    <span id="profileGolDarah" class="text-xs font-black text-rose-600 uppercase"></span>
                    <span id="profileRhesus" class="text-xs font-bold text-rose-400 uppercase"></span>
                </div>
            </div>
            <p id="profileNoPendonor" class="text-sm font-semibold text-slate-500"></p>
            <div class="pt-2 text-xs text-slate-450 space-y-0.5">
                <p>Alamat: <span id="profileAlamat" class="font-medium text-slate-700"></span></p>
                <p>No. Telepon: <span id="profileNoTelp" class="font-medium text-slate-700"></span></p>
            </div>
        </div>

        <!-- Edit Profile Pencil Button (Top Right) -->
        <button type="button" id="btnEditProfile"
            class="absolute top-4 right-4 p-2 rounded-xl text-slate-400 hover:text-emerald-700 hover:bg-emerald-50/50 transition duration-150 focus:outline-none"
            title="Ubah Profil">
            <!-- Pencil Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>
    </div>

    <!-- Info Metrics (Total Donor, Donor Terakhir, Donor Kembali) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Metric 1: Total Donor (Soft Red/Rose) -->
        <div
            class="bg-rose-50/80 p-5 rounded-2xl border border-rose-200/80 shadow-sm text-center flex flex-col justify-between hover:shadow-md hover:border-rose-300 transition duration-200">
            <span class="text-xs font-bold text-rose-500 uppercase tracking-wider">Total Donor</span>
            <span id="metricTotalDonor" class="text-lg font-extrabold text-rose-700 mt-2">0 Kali</span>
        </div>

        <!-- Metric 2: Donor Terakhir (Soft Yellow/Amber) -->
        <div
            class="bg-amber-50/80 p-5 rounded-2xl border border-amber-200/80 shadow-sm text-center flex flex-col justify-between hover:shadow-md hover:border-amber-300 transition duration-200">
            <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Donor Terakhir</span>
            <span id="metricDonorTerakhir" class="text-sm font-extrabold text-amber-800 mt-2">-</span>
        </div>

        <!-- Metric 3: Donor Kembali (Soft Blue) -->
        <div
            class="bg-blue-50/80 p-5 rounded-2xl border border-blue-200/80 shadow-sm text-center flex flex-col justify-between hover:shadow-md hover:border-blue-300 transition duration-200">
            <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">Donor Kembali</span>
            <span id="metricDonorKembali" class="text-sm font-extrabold text-blue-700 mt-2">-</span>
        </div>
    </div>

    <!-- Bottom Actions -->
    <div class="flex justify-center space-x-8 pt-6 border-t border-slate-100">
        <!-- History Action -->
        <button type="button" id="btnHistoriProfile"
            class="flex flex-col items-center space-y-2 group focus:outline-none">
            <div
                class="w-12 h-12 rounded-xl bg-slate-50 group-hover:bg-rose-50 text-slate-500 group-hover:text-rose-600 border border-slate-100 group-hover:border-rose-100 flex items-center justify-center shadow-sm transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span
                class="text-xs font-bold text-slate-650 group-hover:text-rose-600 transition duration-150">Histori</span>
        </button>

        <!-- Daftar Donor Action -->
        <button type="button" id="btnDaftarDonorProfile"
            class="flex flex-col items-center space-y-2 group focus:outline-none">
            <div
                class="w-12 h-12 rounded-xl bg-slate-50 group-hover:bg-rose-50 text-slate-500 group-hover:text-rose-600 border border-slate-100 group-hover:border-rose-100 flex items-center justify-center shadow-sm transition duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-slate-650 group-hover:text-rose-600 transition duration-150">Daftar
                Donor</span>
        </button>
    </div>
</div>

<!-- HISTORY CONTAINER (Hidden by default) -->
<div id="historyContainer" class="hidden w-full space-y-6 animate-fade-in">
    <!-- Header -->
    <div class="flex items-center border-b border-slate-100 pb-4 relative">
        <button type="button" id="btnBackHistory"
            class="flex items-center space-x-2 px-3 py-1.5 rounded-xl text-xs font-bold text-rose-600 border border-rose-200 bg-rose-50/30 hover:bg-rose-50 hover:border-rose-300 transition duration-150 shadow-sm focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </button>
        <h2 class="absolute left-1/2 -translate-x-1/2 text-xl font-extrabold text-rose-600">Riwayat Donor</h2>
    </div>

    <!-- Date Range Filter Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 p-6">
        <div class="flex flex-col space-y-2">
            <label class="text-sm font-semibold text-slate-700">Pilih Rentang Tanggal</label>
            <div class="flex items-center space-x-3">
                <div class="relative flex-1 max-w-sm">
                    <input type="text" id="dateRangePicker"
                        class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 pl-4 pr-10 py-2.5"
                        placeholder="01-06-2026 ~ 06-06-2026">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <button type="button" id="btnTampilkanRiwayat"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-6 rounded-xl text-sm transition duration-150 shadow-sm">
                    Tampilkan
                </button>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-100 p-6">
        <div class="overflow-x-auto rounded-xl border border-slate-100 p-1">
            <table id="historyTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th
                            class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-16 text-center">
                            No</th>
                        <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tgl Pendaftaran
                        </th>
                        <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">No. Formulir</th>
                        <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ruangan
                            Rekrutmen</th>
                        <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status Donor</th>
                        <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Seleksi Donor
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- EDIT PROFILE MODAL -->
<div id="editProfileModal"
    class="hidden fixed inset-0 z-[1050] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition duration-150">
    <div
        class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden animate-scale-up">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-rose-500 to-pink-600 p-6 text-white flex justify-between items-center">
            <h3 class="font-extrabold text-lg">Ubah Profil Pendonor</h3>
            <button type="button" onclick="closeEditModal()"
                class="text-white/80 hover:text-white transition duration-150 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form id="formEditProfile" class="p-6 space-y-4" novalidate>
            @csrf
            <input type="hidden" id="edit_pendonor_id" name="pendonor_id" />

            <!-- Nama Lengkap -->
            <div class="space-y-1.5">
                <label for="edit_nama_lengkap" class="block font-bold text-xs text-slate-700">Nama Lengkap <span
                        class="text-rose-500 font-extrabold">*</span></label>
                <input id="edit_nama_lengkap" type="text" name="nama_lengkap" required
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                    placeholder="Nama Lengkap" />
            </div>

            <!-- Alamat Lengkap -->
            <div class="space-y-1.5">
                <label for="edit_alamat_lengkap" class="block font-bold text-xs text-slate-700">Alamat Lengkap <span
                        class="text-rose-500 font-extrabold">*</span></label>
                <textarea id="edit_alamat_lengkap" name="alamat_lengkap" rows="3" required
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                    placeholder="Alamat Lengkap"></textarea>
            </div>

            <!-- Nomor Telepon (nomobile_pendonor) -->
            <div class="space-y-1.5">
                <label for="edit_nomobile_pendonor" class="block font-bold text-xs text-slate-700">Nomor Telepon <span
                        class="text-rose-500 font-extrabold">*</span></label>
                <input id="edit_nomobile_pendonor" type="text" name="nomobile_pendonor" required
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                    placeholder="Nomor Telepon" />
            </div>

            <!-- Golongan Darah & Rhesus (New) -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="edit_gol_darah" class="block font-bold text-xs text-slate-700">Golongan Darah</label>
                    <select id="edit_gol_darah" name="gol_darah"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm">
                        <option value="">Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label for="edit_rhesus" class="block font-bold text-xs text-slate-700">Rhesus</label>
                    <select id="edit_rhesus" name="rhesus"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm">
                        <option value="">Pilih</option>
                        <option value="Positif">Positif (+)</option>
                        <option value="Negatif">Negatif (-)</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()"
                    class="py-2.5 px-5 text-sm font-bold rounded-xl border border-slate-200 text-slate-650 hover:bg-slate-50 transition duration-150 focus:outline-none">
                    BATAL
                </button>
                <button type="submit"
                    class="bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition duration-150 focus:outline-none text-sm">
                    SIMPAN
                </button>
            </div>
        </form>
    </div>
</div>
