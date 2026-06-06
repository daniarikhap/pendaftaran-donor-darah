<!-- PENDAFTARAN CONTAINER (Hidden by default) -->
<div id="pendaftaranContainer" class="hidden w-full animate-fade-in">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-[2.5rem] border border-rose-100/50 overflow-hidden">
        <div class="p-8 lg:p-12 space-y-8">
            <!-- Header -->
            <div class="flex items-center border-b border-slate-100 pb-6 relative">
                <button type="button" id="btnBackToProfile"
                    class="flex items-center space-x-2 px-4 py-2 rounded-xl text-xs font-bold text-rose-600 border border-rose-200 bg-rose-50/30 hover:bg-rose-50 hover:border-rose-300 transition duration-150 shadow-sm focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali</span>
                </button>
                <h2 class="absolute left-1/2 -translate-x-1/2 text-2xl font-black text-rose-600 tracking-tight">
                    Pendaftaran Donor Darah
                </h2>
            </div>

            <form id="formPendaftaranDonor" class="space-y-8">
                @csrf
                <!-- Data Pendaftaran Donor Section -->
                <div class="bg-slate-50/50 rounded-2xl border border-slate-100 p-6 lg:p-8 space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-rose-50 rounded-xl text-rose-500 border border-rose-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Data Pendaftaran Donor</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Tanggal -->
                        <div class="space-y-2">
                            <label class="block font-bold text-[10px] text-slate-500 uppercase tracking-widest">Tanggal <span
                                    class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <input type="text" name="tgl_pendaftaran" id="pendaftaran_tgl"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm shadow-sm"
                                    placeholder="{{ date('d-m-Y') }}" />
                                <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="space-y-2">
                            <label class="block font-bold text-[10px] text-slate-500 uppercase tracking-widest">Tinggi Badan
                                (Cm)
                                <span class="text-rose-500">*</span></label>
                            <input type="number" name="tinggibadan_cm" placeholder="Contoh: 170" min="0"
                                class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm shadow-sm" />
                        </div>

                        <!-- Lokasi Donor Darah -->
                        <div class="space-y-2">
                            <label class="block font-bold text-[10px] text-slate-500 uppercase tracking-widest">Lokasi Donor
                                Darah
                                <span class="text-rose-500">*</span></label>
                            <select name="ruangan_id" id="pendaftaran_lokasi" class="w-full select2-location">
                                <option value="">Pilih Lokasi</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->ruangan_id }}">{{ $ruangan->ruangan_nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Berat Badan -->
                        <div class="space-y-2">
                            <label class="block font-bold text-[10px] text-slate-500 uppercase tracking-widest">Berat Badan
                                (Kg)
                                <span class="text-rose-500">*</span></label>
                            <input type="number" name="beratbadan_kg" placeholder="Contoh: 65" min="0"
                                class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150 text-sm shadow-sm" />
                        </div>
                    </div>
                </div>

                <!-- Kuesioner Donor Darah Section -->
                <div class="bg-slate-50/50 rounded-2xl border border-slate-100 p-6 lg:p-8 space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-rose-50 rounded-xl text-rose-500 border border-rose-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Kuesioner Donor Darah</h3>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-100 bg-white p-1 shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th
                                        class="py-4 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest w-16 text-center">
                                        NO</th>
                                    <th class="py-4 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                        PERTANYAAN</th>
                                    <th
                                        class="py-4 px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest w-40 text-center">
                                        PILIHAN JAWABAN</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($kuesioners as $kuesioner)
                                    <tr class="hover:bg-slate-50/50 transition duration-150">
                                        <td class="py-4 px-4 text-sm font-bold text-slate-400 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-slate-700 font-medium leading-relaxed">
                                            {{ $kuesioner->kuesioner_desc }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center justify-center space-x-3">
                                                <label class="relative inline-flex items-center cursor-pointer group">
                                                    <input type="radio" name="jawaban[{{ $kuesioner->kuesionerdonor_id }}]"
                                                        value="1" class="sr-only peer" required>
                                                    <div
                                                        class="px-4 py-1.5 rounded-xl border border-slate-200 text-[10px] font-black text-slate-400 peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-600 transition duration-150 hover:border-slate-300">
                                                        YA
                                                    </div>
                                                </label>
                                                <label class="relative inline-flex items-center cursor-pointer group">
                                                    <input type="radio" name="jawaban[{{ $kuesioner->kuesionerdonor_id }}]"
                                                        value="0" class="sr-only peer" required>
                                                    <div
                                                        class="px-4 py-1.5 rounded-xl border border-slate-200 text-[10px] font-black text-slate-400 peer-checked:bg-rose-50 peer-checked:border-rose-500 peer-checked:text-rose-600 transition duration-150 hover:border-slate-300">
                                                        TIDAK
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-black py-4 px-12 rounded-2xl shadow-xl shadow-rose-500/25 transition duration-200 focus:outline-none text-xs uppercase tracking-widest hover:-translate-y-0.5 transform active:scale-95">
                        Daftar Donor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>