<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Tambah Data Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-rose-50/50 blur-2xl pointer-events-none"></div>

                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Tambah Pekerjaan Baru</h3>
                        <p class="text-xs text-slate-500">Masukkan nama pekerjaan resmi.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('pekerjaan.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="pekerjaan_nama" class="block text-sm font-semibold text-slate-700 mb-1">Nama Pekerjaan <span class="text-red-500">*</span></label>
                        <input type="text" name="pekerjaan_nama" id="pekerjaan_nama" 
                               placeholder="Contoh: Pegawai Swasta" value="{{ old('pekerjaan_nama') }}"
                               class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('pekerjaan_nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                        @error('pekerjaan_nama')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('pekerjaan.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-5 rounded-xl text-sm transition duration-150">
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
