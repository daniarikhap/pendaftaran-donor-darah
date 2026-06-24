<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Seleksi Donor Darah') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100">
                <div class="p-8">
                    <div class="mb-8 pb-4 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800">Seleksi Donor Darah</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">No. Formulir</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->no_formulir }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">No. Registrasi</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->no_pendonor }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Nama Pendonor</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->nama_lengkap }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Tanggal Lahir</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->tgllahir->format('d M Y') }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Umur</label>
                                <div class="col-span-2">
                                    @php
                                        $diff = \Carbon\Carbon::parse($donor->pendonor->tgllahir)->diff(\Carbon\Carbon::now());
                                        $umurText = sprintf('%d Tahun %02d Bulan %02d Hari', $diff->y, $diff->m, $diff->d);
                                    @endphp
                                    <input type="text" value="{{ $umurText }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Jenis Kelamin</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ strtoupper($donor->pendonor->jenis_kelamin) }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Golongan Darah</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->gol_darah }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Rhesus</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->rhesus }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Status Perkawinan</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->statusperkawinan }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600 leading-tight">Riwayat donor terakhir</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $riwayatTerakhir ? $riwayatTerakhir->waktu_pendaftaran->format('d M Y') : '-' }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-center">
                                <label class="text-sm font-bold text-slate-600">Berat Badan</label>
                                <div class="col-span-2">
                                    <input type="text" value="{{ $donor->pendonor->beratbadan_kg }}" readonly
                                        class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-slate-50 text-sm focus:outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex justify-end gap-4">
                        <a href="{{ route('admin.data-donor') }}"
                            class="px-6 py-2 bg-slate-100 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-200 transition-all">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100" x-data="{ activeTab: 'vital' }">
                <div class="flex border-b border-slate-100">
                    <button @click="activeTab = 'kuesioner'"
                        :class="activeTab === 'kuesioner' ? 'border-rose-500 text-rose-600 bg-rose-50/30' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50'"
                        class="px-8 py-4 text-sm font-bold border-b-2 transition-all">
                        Seleksi Kuesioner
                    </button>
                    <button @click="activeTab = 'vital'"
                        :class="activeTab === 'vital' ? 'border-rose-500 text-rose-600 bg-rose-50/30' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50'"
                        class="px-8 py-4 text-sm font-bold border-b-2 transition-all">
                        Seleksi Tanda Vital
                    </button>
                </div>

                <div class="p-8">
                    <!-- Seleksi Kuesioner Tab -->
                    <div x-show="activeTab === 'kuesioner'" x-cloak>
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-slate-800 mb-6">Riwayat Isian Kuesioner</h3>
                            <div class="overflow-hidden border border-slate-100 rounded-xl">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-100">
                                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-16 text-center">No</th>
                                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pertanyaan</th>
                                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-32 text-center">Jawaban</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($jawabanKuesioner as $jawaban)
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-6 py-4 text-sm text-slate-500 text-center font-medium">{{ $loop->iteration }}</td>
                                                <td class="px-6 py-4 text-sm text-slate-600 leading-relaxed">{{ $jawaban->kuesionerdonor->kuesioner_desc }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    @if($jawaban->ceklist)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                            YA
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                                            TIDAK
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Seleksi Tanda Vital Tab -->
                    <div x-show="activeTab === 'vital'" x-cloak>
                        @php
                            $hasSeleksi = $donor->seleksiDonor !== null;
                            $isReadOnly = $hasSeleksi ? 'disabled' : '';
                            $seleksi = $donor->seleksiDonor;
                        @endphp
                        <form action="{{ route('admin.seleksi-donor.store', $donor->daftardonor_id) }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="p-6 border border-slate-100 rounded-2xl bg-slate-50/30">
                                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-6 pb-2 border-b border-slate-100">Seleksi Donor Darah</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                                    <div class="space-y-6">
                                        <!-- Jenis Donor -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Jenis Donor Darah<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2 flex gap-4">
                                                <label class="flex items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="jenis_donor" value="Sukarela" {{ old('jenis_donor', $hasSeleksi ? $seleksi->jenisdonor : 'Sukarela') == 'Sukarela' ? 'checked' : '' }} {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                    <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Sukarela</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="jenis_donor" value="Pengganti" {{ old('jenis_donor', $hasSeleksi ? $seleksi->jenisdonor : '') == 'Pengganti' ? 'checked' : '' }} {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                    <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Pengganti</span>
                                                </label>
                                                <label class="flex items-center gap-2 cursor-pointer group">
                                                    <input type="radio" name="jenis_donor" value="Apheresis" {{ old('jenis_donor', $hasSeleksi ? $seleksi->jenisdonor : '') == 'Apheresis' ? 'checked' : '' }} {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                    <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Apheresis</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Tekanan Darah -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Tekanan Darah<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2 flex items-center gap-2">
                                                <input type="text" name="tensi_sistole" value="{{ old('tensi_sistole', $hasSeleksi ? $seleksi->td_systolic : '') }}" {{ $isReadOnly }} placeholder="Sistole" 
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="w-24 px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                                <span class="text-slate-400 font-bold">/</span>
                                                <input type="text" name="tensi_diastole" value="{{ old('tensi_diastole', $hasSeleksi ? $seleksi->td_diastoliic : '') }}" {{ $isReadOnly }} placeholder="Diastole" 
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="w-24 px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                                <span class="text-xs font-bold text-slate-400 ml-2">mmHg</span>
                                            </div>
                                        </div>

                                        <!-- Kadar HB -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Kadar Hemoglobin<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2">
                                                <input type="text" name="kadar_hb" value="{{ old('kadar_hb', $hasSeleksi ? $seleksi->kadar_hb : '') }}" {{ $isReadOnly }} 
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <!-- Suhu Tubuh -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Suhu Tubuh<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2">
                                                <input type="text" name="suhu_tubuh" value="{{ old('suhu_tubuh', $hasSeleksi ? $seleksi->suhu_tubuh : '') }}" {{ $isReadOnly }} 
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                            </div>
                                        </div>

                                        <!-- Detak Nadi -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Detak Nadi<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2">
                                                <input type="text" name="denyut_nadi" value="{{ old('denyut_nadi', $hasSeleksi ? $seleksi->detaknadi : '') }}" {{ $isReadOnly }} 
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                            </div>
                                        </div>

                                        <!-- Gol Darah & Rhesus -->
                                        <div class="grid grid-cols-3 items-center">
                                            <label class="text-sm font-bold text-slate-600">Gol Darah / Rh<span class="text-rose-500">*</span></label>
                                            <div class="col-span-2 flex gap-4">
                                                <select name="gol_darah" {{ $isReadOnly }} class="flex-1 px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                                    @foreach(['A', 'B', 'O', 'AB'] as $gd)
                                                        <option value="{{ $gd }}" {{ old('gol_darah', $hasSeleksi ? $seleksi->gol_darah : $donor->pendonor->gol_darah) == $gd ? 'selected' : '' }}>{{ $gd }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="rhesus" {{ $isReadOnly }} class="flex-1 px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                                    @foreach(['Positif', 'Negatif'] as $rh)
                                                        <option value="{{ $rh }}" {{ old('rhesus', $hasSeleksi ? $seleksi->rhesus : $donor->pendonor->rhesus) == $rh ? 'selected' : '' }}>{{ $rh }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-data="{ 
                                 isRejected: {{ old('is_ditolak', $hasSeleksi ? $seleksi->alasan_ditolak : false) || $errors->has('is_ditolak') ? 'true' : 'false' }},
                                 medisLain: {{ old('alasan_medis_active', $hasSeleksi ? $seleksi->medis_lain : false) ? 'true' : 'false' }},
                                 perilakuResiko: {{ old('alasan_resiko_active', $hasSeleksi ? $seleksi->perilakuberesiko : false) ? 'true' : 'false' }},
                                 riwayatBepergian: {{ old('alasan_bepergian_active', $hasSeleksi ? $seleksi->riwberpergian : false) ? 'true' : 'false' }},
                                 lainLain: {{ old('alasan_lain_active', $hasSeleksi ? $seleksi->lain_lain : false) ? 'true' : 'false' }},
                                 alasan_medis: '{{ old('alasan_medis', $hasSeleksi ? ($seleksi->medis_tk_tinggi ? 'Hipertensi' : ($seleksi->medis_td_rendah ? 'Hipotensi' : ($seleksi->minum_obat ? 'Minum Obat' : ($seleksi->medis_pasca_op ? 'Pasca Op' : ($seleksi->medis_hb_17 ? 'HB > 17,0 gr %' : ($seleksi->medis_vaksin ? 'Sakit / vaksin / haid / busui' : ($seleksi->medis_bb_lebih ? 'BB >=' : ''))))))) : '') }}',
                                 alasan_resiko: '{{ old('alasan_resiko', $hasSeleksi ? ($seleksi->perilakuberesiko_homo ? 'Homo' : ($seleksi->perilakuberesiko_tatto ? 'Tato' : ($seleksi->perilakuberesiko_freesx ? 'Free Sex' : ($seleksi->perilakuberesiko_penasun ? 'Penasun' : ($seleksi->perilakuberesiko_napi ? 'Napi' : ''))))) : '') }}',
                                 alasan_bepergian: '{{ old('alasan_bepergian', $hasSeleksi ? ($seleksi->riwbepergian_endemik ? 'Daerah Endemik' : ($seleksi->riwbepergian_hiv ? 'Negara dg Kasus HIV' : ($seleksi->riwbepergian_sapigila ? 'Negara dg Kasus Sapi Gila' : ''))) : '') }}',
                                 alasan_lain: '{{ old('alasan_lain', $hasSeleksi ? ($seleksi->lain_lain_tdkkembali ? 'Tidak Kembali' : ($seleksi->lain_lain_donortua ? 'Donor Pertama Usia > 65Th' : '')) : '') }}',
                                 alasan_bb: {{ (is_array(old('alasan')) && in_array('BB < 45Kg', old('alasan'))) || ($hasSeleksi && $seleksi->bb_rendah) ? 'true' : 'false' }},
                                 alasan_usia: {{ (is_array(old('alasan')) && in_array('Usia < 17 Tahun', old('alasan'))) || ($hasSeleksi && $seleksi->usia_kurang) ? 'true' : 'false' }},
                                 alasan_hb: {{ (is_array(old('alasan')) && in_array('HB <', old('alasan'))) || ($hasSeleksi && $seleksi->hb_rendah) ? 'true' : 'false' }},
                                 
                                 resetAll() {
                                     if(!this.isRejected) {
                                         this.medisLain = false;
                                         this.perilakuResiko = false;
                                         this.riwayatBepergian = false;
                                         this.lainLain = false;
                                         this.alasan_medis = '';
                                         this.alasan_resiko = '';
                                         this.alasan_bepergian = '';
                                         this.alasan_lain = '';
                                         this.alasan_bb = false;
                                         this.alasan_usia = false;
                                         this.alasan_hb = false;
                                     }
                                 }
                             }">
                                 <label class="flex items-center gap-3 cursor-pointer group mb-6">
                                     <input type="checkbox" name="is_ditolak" x-model="isRejected" @change="resetAll()" {{ $isReadOnly }} class="w-5 h-5 text-rose-600 border-slate-300 rounded focus:ring-rose-500" {{ old('is_ditolak') || ($hasSeleksi && $seleksi->alasan_ditolak) ? 'checked' : '' }}>
                                     <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">Cek jika pendonor darah ditolak atau gagal</span>
                                 </label>

                                 @error('is_ditolak')
                                     <script>
                                         document.addEventListener('DOMContentLoaded', function () {
                                             Swal.fire({
                                                 icon: 'error',
                                                 title: 'Oops...',
                                                 text: '{{ $message }}',
                                                 confirmButtonColor: '#e11d48', // rose-600
                                                 customClass: {
                                                     popup: 'rounded-2xl',
                                                     confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                                                 }
                                             });
                                         });
                                     </script>
                                 @enderror

                                 <div x-show="isRejected" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="border border-slate-200 rounded-lg overflow-hidden mb-6">
                                     <div class="bg-slate-50 px-4 py-2 border-b border-slate-200">
                                         <h4 class="text-sm font-bold text-slate-700">Alasan Ditolak / Gagal Seleksi</h4>
                                     </div>
                                     <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                                         <!-- Column 1 -->
                                         <div class="space-y-4">
                                             <label class="flex items-center gap-3 cursor-pointer group">
                                                 <input type="checkbox" name="alasan[]" value="BB < 45Kg" x-model="alasan_bb" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                 <span class="text-sm text-slate-600 group-hover:text-slate-900">BB < 45Kg</span>
                                             </label>
                                             <label class="flex items-center gap-3 cursor-pointer group">
                                                 <input type="checkbox" name="alasan[]" value="Usia < 17 Tahun" x-model="alasan_usia" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                 <span class="text-sm text-slate-600 group-hover:text-slate-900">Usia < 17 Tahun</span>
                                             </label>
                                             <label class="flex items-center gap-3 cursor-pointer group">
                                                 <input type="checkbox" name="alasan[]" value="HB <" x-model="alasan_hb" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                 <span class="text-sm text-slate-600 group-hover:text-slate-900">HB <</span>
                                             </label>
                                             <div class="space-y-3">
                                                 <label class="flex items-center gap-3 cursor-pointer group">
                                                     <input type="checkbox" name="alasan_medis_active" x-model="medisLain" @change="if(!medisLain) alasan_medis = ''" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                     <span class="text-sm text-slate-600 group-hover:text-slate-900">Medis Lain :</span>
                                                 </label>
                                                 <div class="pl-10 space-y-2.5">
                                                     @foreach(['Hipertensi', 'Hipotensi', 'Minum Obat', 'Pasca Op', 'HB > 17,0 gr %', 'Sakit / vaksin / haid / busui', 'BB >='] as $medis)
                                                         <label class="flex items-center gap-3 cursor-pointer group" :class="!medisLain ? 'opacity-50 cursor-not-allowed' : ''">
                                                             <input type="radio" name="alasan_medis" value="{{ $medis }}" x-model="alasan_medis" :disabled="!medisLain || {{ $hasSeleksi ? 'true' : 'false' }}" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                             <span class="text-sm text-slate-500 group-hover:text-slate-800">{{ $medis }}</span>
                                                         </label>
                                                     @endforeach
                                                 </div>
                                             </div>
                                         </div>
 
                                         <!-- Column 2 -->
                                         <div class="space-y-6">
                                             <!-- Perilaku Beresiko -->
                                             <div class="space-y-3">
                                                 <label class="flex items-center gap-3 cursor-pointer group">
                                                     <input type="checkbox" name="alasan_resiko_active" x-model="perilakuResiko" @change="if(!perilakuResiko) alasan_resiko = ''" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                     <span class="text-sm text-slate-600 group-hover:text-slate-900">Perilaku Beresiko :</span>
                                                 </label>
                                                 <div class="pl-10 space-y-2.5">
                                                     @foreach(['Homo', 'Tato', 'Free Sex', 'Penasun', 'Napi'] as $resiko)
                                                         <label class="flex items-center gap-3 cursor-pointer group" :class="!perilakuResiko ? 'opacity-50 cursor-not-allowed' : ''">
                                                             <input type="radio" name="alasan_resiko" value="{{ $resiko }}" x-model="alasan_resiko" :disabled="!perilakuResiko || {{ $hasSeleksi ? 'true' : 'false' }}" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                             <span class="text-sm text-slate-500 group-hover:text-slate-800">{{ $resiko }}</span>
                                                         </label>
                                                     @endforeach
                                                 </div>
                                             </div>
 
                                             <!-- Riwayat Bepergian -->
                                             <div class="space-y-3">
                                                 <label class="flex items-center gap-3 cursor-pointer group">
                                                     <input type="checkbox" name="alasan_bepergian_active" x-model="riwayatBepergian" @change="if(!riwayatBepergian) alasan_bepergian = ''" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                     <span class="text-sm text-slate-600 group-hover:text-slate-900">Riwayat Bepergian :</span>
                                                 </label>
                                                 <div class="pl-10 space-y-2.5">
                                                     @foreach(['Daerah Endemik', 'Negara dg Kasus HIV', 'Negara dg Kasus Sapi Gila'] as $bepergian)
                                                         <label class="flex items-center gap-3 cursor-pointer group" :class="!riwayatBepergian ? 'opacity-50 cursor-not-allowed' : ''">
                                                             <input type="radio" name="alasan_bepergian" value="{{ $bepergian }}" x-model="alasan_bepergian" :disabled="!riwayatBepergian || {{ $hasSeleksi ? 'true' : 'false' }}" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                             <span class="text-sm text-slate-500 group-hover:text-slate-800">{{ $bepergian }}</span>
                                                         </label>
                                                     @endforeach
                                                 </div>
                                             </div>
 
                                             <!-- Lain-lain -->
                                             <div class="space-y-3">
                                                 <label class="flex items-center gap-3 cursor-pointer group">
                                                     <input type="checkbox" name="alasan_lain_active" x-model="lainLain" @change="if(!lainLain) alasan_lain = ''" {{ $isReadOnly }} class="w-4 h-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500">
                                                     <span class="text-sm text-slate-600 group-hover:text-slate-900">Lain-lain :</span>
                                                 </label>
                                                 <div class="pl-10 space-y-2.5">
                                                     @foreach(['Tidak Kembali', 'Donor Pertama Usia > 65Th'] as $lain)
                                                         <label class="flex items-center gap-3 cursor-pointer group" :class="!lainLain ? 'opacity-50 cursor-not-allowed' : ''">
                                                             <input type="radio" name="alasan_lain" value="{{ $lain }}" x-model="alasan_lain" :disabled="!lainLain || {{ $hasSeleksi ? 'true' : 'false' }}" class="w-4 h-4 text-rose-600 border-slate-300 focus:ring-rose-500">
                                                             <span class="text-sm text-slate-500 group-hover:text-slate-800">{{ $lain }}</span>
                                                         </label>
                                                     @endforeach
                                                 </div>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                                <div class="grid grid-cols-3 items-center">
                                    <label class="text-sm font-bold text-slate-600">Catatan Dokter</label>
                                    <div class="col-span-2">
                                        <input type="text" name="catatan_dokter" value="{{ old('catatan_dokter', $hasSeleksi ? $seleksi->catatan_dokter : '') }}" {{ $isReadOnly }} class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all">
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 items-center">
                                    <label class="text-sm font-bold text-slate-600">Tanggal Seleksi</label>
                                    <div class="col-span-2 relative group">
                                        <input type="text" name="tgl_seleksi" id="tgl_seleksi" value="{{ old('tgl_seleksi', $hasSeleksi ? $seleksi->tglseleksidonor->format('Y-m-d') : date('Y-m-d')) }}" {{ $isReadOnly }} 
                                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150">
                                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (!$hasSeleksi)
                                <div class="pt-6 border-t border-slate-100 flex justify-end">
                                    <button type="submit" class="px-8 py-3 bg-rose-600 text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Seleksi
                                    </button>
                                </div>
                            @endif
                        </form>

                        @if ($hasSeleksi && $seleksi->status_donor_kunjungan === 'Siap Donor')
                            <div class="pt-6 border-t border-slate-100 flex flex-col items-end gap-6" x-data="{ showBatalForm: false }">
                                <div class="flex gap-4">
                                    <!-- Form Konfirmasi Donor Berhasil -->
                                    <form action="{{ route('admin.seleksi-donor.konfirmasi', $donor->daftardonor_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-3 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Konfirmasi Donor Berhasil
                                        </button>
                                    </form>

                                    <!-- Button Batal Donor -->
                                    <button type="button" @click="showBatalForm = !showBatalForm" class="px-6 py-3 bg-rose-600 text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Batalkan Donor
                                    </button>
                                </div>

                                <!-- Form Keterangan Batal Donor -->
                                <div x-show="showBatalForm" x-cloak x-transition class="w-full max-w-md p-6 bg-slate-50 border border-slate-200 rounded-2xl space-y-4">
                                    <form action="{{ route('admin.seleksi-donor.batal', $donor->daftardonor_id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div>
                                            <label for="keterangan_donor" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Keterangan Batal Donor</label>
                                            <textarea name="keterangan_donor" id="keterangan_donor" rows="3" required placeholder="Masukkan alasan atau keterangan pembatalan..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm outline-none transition-all"></textarea>
                                        </div>
                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="showBatalForm = false" class="px-4 py-2 bg-slate-200 text-slate-600 text-xs font-bold rounded-lg hover:bg-slate-300">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-rose-600 text-white text-xs font-bold rounded-lg hover:bg-rose-700">
                                                Simpan Pembatalan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif ($hasSeleksi && $seleksi->status_donor_kunjungan === 'Batal Donor')
                            <div class="pt-6 border-t border-slate-100 space-y-4">
                                <div class="p-6 bg-rose-50 border border-rose-100 rounded-2xl">
                                    <h4 class="text-sm font-bold text-rose-800 uppercase tracking-wider mb-2">Informasi Pembatalan Donor</h4>
                                    <div class="grid grid-cols-3 gap-4 items-start">
                                        <span class="text-xs font-bold text-rose-700 uppercase">Keterangan Batal Donor:</span>
                                        <div class="col-span-2 text-sm text-rose-900 bg-white/50 p-4 rounded-xl border border-rose-100/50">
                                            {{ $seleksi->keterangan_donor }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#tgl_seleksi", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d/m/Y",
                    allowInput: true,
                    clickOpens: {{ $donor->seleksiDonor ? 'false' : 'true' }}
                });
            });
        </script>
    @endpush
</x-app-layout>
