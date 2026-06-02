<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Data Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-rose-50/50 blur-2xl pointer-events-none"></div>

                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Tambah Ruangan Baru</h3>
                        <p class="text-xs text-slate-500">Masukkan nama ruangan dan singkatan resmi ruangan.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('ruangan.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="ruangan_nama" class="block text-sm font-semibold text-slate-700 mb-1">Nama Ruangan <span class="text-red-500">*</span></label>
                        <input type="text" name="ruangan_nama" id="ruangan_nama" 
                               placeholder="Contoh: Ruang Rekrutmen Donor" value="{{ old('ruangan_nama') }}"
                               class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('ruangan_nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                        @error('ruangan_nama')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ruangan_singkatan" class="block text-sm font-semibold text-slate-700 mb-1">Singkatan Ruangan <span class="text-red-500">*</span></label>
                        <input type="text" name="ruangan_singkatan" id="ruangan_singkatan" 
                               placeholder="Contoh: RRD" value="{{ old('ruangan_singkatan') }}"
                               class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('ruangan_singkatan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                        @error('ruangan_singkatan')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
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
