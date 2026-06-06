<!-- TAB 1: PENDONOR LAMA -->
<div id="sectionLama" class="space-y-6">
    <form id="formLama" class="space-y-5" novalidate>
        <!-- Pilih Nomor KTP / Nomor Pendonor -->
        <div class="space-y-1.5">
            <label for="lama_jenis_identitas" class="block font-bold text-xs text-slate-700">Pilih Nomor KTP / Nomor
                Pendonor</label>
            <select id="lama_jenis_identitas" name="jenis_identitas" required
                class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 cursor-pointer text-sm">
                <option value="" disabled selected>-- Pilih --</option>
                <option value="NIK_KTP">Nomor KTP (NIK)</option>
                <option value="NO_PENDONOR">Nomor Pendonor</option>
            </select>
        </div>

        <!-- KTP / Nomor Pendonor Input -->
        <div class="space-y-1.5">
            <label id="lama_label_identitas" for="lama_identitas_value"
                class="block font-bold text-xs text-slate-700">KTP / Nomor Pendonor <span
                    class="text-rose-500 font-extrabold">*</span></label>
            <input id="lama_identitas_value" type="text" name="identitas_value" required
                class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 placeholder-slate-400 text-sm"
                placeholder="KTP / Nomor Pendonor" />
        </div>

        <!-- Tanggal Lahir -->
        <div class="space-y-1.5">
            <label for="lama_tgllahir" class="block font-bold text-xs text-slate-700">Tanggal Lahir <span
                    class="text-rose-500 font-extrabold">*</span></label>
            <div class="relative group">
                <input id="lama_tgllahir" type="text" name="tgllahir" required
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm placeholder-slate-400"
                    placeholder="dd/mm/yyyy" />
                <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
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
