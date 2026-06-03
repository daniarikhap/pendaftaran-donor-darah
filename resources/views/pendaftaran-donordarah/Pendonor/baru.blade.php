<!-- TAB 2: PENDONOR BARU -->
<div id="sectionBaru" class="space-y-6 hidden">
    <!-- Sub-Tabs (Pegawai vs Umum) -->
    <div class="flex space-x-2 bg-slate-50 p-1 rounded-xl border border-slate-100 max-w-[240px]">
        <button type="button" id="subTabPegawai" onclick="switchSubTab('pegawai')"
            class="flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none border border-rose-200 text-rose-600 hover:bg-rose-50/50">
            Pegawai
        </button>
        <button type="button" id="subTabUmum" onclick="switchSubTab('umum')"
            class="flex-1 py-1.5 px-4 text-xs font-bold rounded-lg transition duration-200 focus:outline-none bg-rose-500 text-white shadow-sm">
            Umum
        </button>
    </div>

    @include('pendaftaran-donordarah.Pendonor.umum')
    @include('pendaftaran-donordarah.Pendonor.pegawai')
</div>
