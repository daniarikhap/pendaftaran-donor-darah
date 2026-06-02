<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Ubah Data Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-rose-50/50 blur-2xl pointer-events-none"></div>

                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Ubah Data Ruangan</h3>
                        <p class="text-xs text-slate-500">Sesuaikan nama ruangan, singkatan resmi, dan status keaktifan ruangan.</p>
                    </div>
                    <a href="{{ route('ruangan.index') }}" class="inline-flex items-center text-slate-500 hover:text-slate-800 text-sm font-semibold transition duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('ruangan.update', $ruangan->ruangan_id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="ruangan_nama" class="block text-sm font-semibold text-slate-700 mb-1">Nama Ruangan <span class="text-red-500">*</span></label>
                        <input type="text" name="ruangan_nama" id="ruangan_nama" 
                               placeholder="Contoh: Ruang Rekrutmen Donor" value="{{ old('ruangan_nama', $ruangan->ruangan_nama) }}"
                               class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('ruangan_nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                        @error('ruangan_nama')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="ruangan_singkatan" class="block text-sm font-semibold text-slate-700 mb-1">Singkatan Ruangan <span class="text-red-500">*</span></label>
                            <input type="text" name="ruangan_singkatan" id="ruangan_singkatan" 
                                   placeholder="Contoh: RRD" value="{{ old('ruangan_singkatan', $ruangan->ruangan_singkatan) }}"
                                   class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('ruangan_singkatan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('ruangan_singkatan')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <label class="inline-flex items-center mt-6 cursor-pointer select-none">
                                <input type="checkbox" name="pekerjaan_aktif" value="1" {{ old('pekerjaan_aktif', $ruangan->pekerjaan_aktif) ? 'checked' : '' }}
                                       class="rounded text-rose-600 focus:ring-rose-500 border-slate-300 w-5 h-5 transition duration-150">
                                <span class="ml-2.5 text-sm font-semibold text-slate-700">Aktif</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('ruangan.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-5 rounded-xl text-sm transition duration-150">
                             Batal
                        </a>
                        <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 px-6 rounded-xl text-sm transition duration-150 shadow-sm shadow-rose-100">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
