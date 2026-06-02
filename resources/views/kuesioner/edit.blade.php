<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Ubah Data Kuesioner') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-rose-50/50 blur-2xl pointer-events-none"></div>

                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Ubah Data Kuesioner</h3>
                        <p class="text-xs text-slate-500">Sesuaikan deskripsi pertanyaan, urutan tampilan, dan status aktif kuesioner.</p>
                    </div>
                    <a href="{{ route('kuesioner.index') }}" class="inline-flex items-center text-slate-500 hover:text-slate-800 text-sm font-semibold transition duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('kuesioner.update', $kuesioner->kuesionerdonor_id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="kuesioner_desc" class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Kuesioner</label>
                        <textarea name="kuesioner_desc" id="kuesioner_desc" rows="4" 
                                  placeholder="Contoh: Apakah Anda merasa sehat hari ini?"
                                  class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('kuesioner_desc') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">{{ old('kuesioner_desc', $kuesioner->kuesioner_desc) }}</textarea>
                        @error('kuesioner_desc')
                            <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="kuesioner_urutan" class="block text-sm font-semibold text-slate-700 mb-1">Urutan</label>
                            <input type="number" name="kuesioner_urutan" id="kuesioner_urutan" min="1" 
                                   value="{{ old('kuesioner_urutan', $kuesioner->kuesioner_urutan) }}" placeholder="1"
                                   class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150 @error('kuesioner_urutan') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('kuesioner_urutan')
                                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <label class="inline-flex items-center mt-6 cursor-pointer select-none">
                                <input type="checkbox" name="kuesioner_aktif" value="1" {{ old('kuesioner_aktif', $kuesioner->kuesioner_aktif) ? 'checked' : '' }}
                                       class="rounded text-rose-600 focus:ring-rose-500 border-slate-300 w-5 h-5 transition duration-150">
                                <span class="ml-2.5 text-sm font-semibold text-slate-700">Aktif</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('kuesioner.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-5 rounded-xl text-sm transition duration-150">
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
