<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Data Donor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Search Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 mb-8">
                <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4">Filter Pencarian</h3>
                <form action="{{ route('admin.data-donor') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="tgl_pendaftaran"
                            class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Tanggal Pendaftaran</label>
                        <div class="relative group">
                            <input type="text" name="tgl_pendaftaran" id="tgl_pendaftaran"
                                value="{{ request('tgl_pendaftaran') }}" placeholder="dd/mm/yyyy"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150">
                            <div
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="no_formulir" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">No.
                            Formulir</label>
                        <input type="text" name="no_formulir" id="no_formulir" value="{{ request('no_formulir') }}"
                            placeholder="Ketik No. Formulir..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="no_pendonor" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">No.
                            Registrasi Donor</label>
                        <input type="text" name="no_pendonor" id="no_pendonor" value="{{ request('no_pendonor') }}"
                            placeholder="Ketik No. Registrasi..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="nama_pendonor" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama
                            Pendonor</label>
                        <input type="text" name="nama_pendonor" id="nama_pendonor"
                            value="{{ request('nama_pendonor') }}" placeholder="Ketik Nama..."
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition duration-150">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2.5 bg-[#0f172a] text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('admin.data-donor') }}"
                            class="px-6 py-2.5 bg-[#e11d48] text-white text-sm font-bold rounded-xl hover:bg-rose-700 transition-all shadow-sm flex items-center justify-center min-w-[100px]">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100">
                <div class="p-6">
                    <table id="donorTable" class="w-full text-left border-collapse table-auto min-w-[1200px]" style="width: 100%">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-100">
                                    <th
                                        class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight text-center">
                                        NO</th>
                                    <th
                                        class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                        TGL PENDAFTARAN /<br>FORMULIR</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    NO REGRISTRASI<br>DONOR DARAH</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    NOMOR IDENTITAS</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    NAMA PENDONOR</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    JENIS KELAMIN</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight text-center">
                                    USIA</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    ALAMAT</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    BERAT / TINGGI<br>BADAN</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight text-center">
                                    GOLONGAN<br>DARAH (RHESUS)</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider leading-tight">
                                    RUANGAN<br>REKRUITMEN</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                    STATUS DONOR</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                    SELEKSI DONOR</th>
                                <th
                                    class="px-4 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                    BATAL DONOR</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($daftarDonors as $donor)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-4 py-5 align-top text-center text-[12px] font-bold text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-5 align-top">
                                        <div class="text-[13px] font-bold text-slate-600">
                                            {{ $donor->waktu_pendaftaran->format('d/m/Y') }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">{{ $donor->no_formulir }}</div>
                                    </td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-500">
                                        {{ $donor->pendonor->no_pendonor }}</td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-500">
                                        {{ $donor->pendonor->no_identitas }}</td>
                                    <td
                                        class="px-4 py-5 align-top text-[13px] text-slate-600 font-bold uppercase leading-snug max-w-[150px] break-words">
                                        {{ $donor->pendonor->nama_lengkap }}
                                    </td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-600">
                                        {{ $donor->pendonor->jenis_kelamin }}</td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-600 text-center">
                                        <div class="font-bold">
                                            {{ \Carbon\Carbon::parse($donor->pendonor->tgllahir)->age }}</div>
                                        <div class="text-[10px]">Tahun</div>
                                    </td>
                                    <td
                                        class="px-4 py-5 align-top text-[12px] text-slate-600 max-w-[200px] whitespace-normal leading-relaxed">
                                        {{ $donor->pendonor->alamat_lengkap }}
                                    </td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-600 whitespace-nowrap">
                                        {{ $donor->beratbadan_kg }}kg / {{ $donor->tinggibadan_cm }}cm
                                    </td>
                                    <td class="px-4 py-5 align-top text-[12px] text-slate-600 text-center font-bold">
                                        {{ $donor->pendonor->gol_darah }}<br>
                                        <span class="text-[10px] font-medium">({{ $donor->pendonor->rhesus }})</span>
                                    </td>
                                    <td
                                        class="px-4 py-5 align-top text-[12px] text-slate-600 whitespace-normal leading-relaxed">
                                        {{ $donor->ruanganRekruitmen->ruangan_nama ?? '-' }}
                                    </td>
                                    <td class="px-4 py-5 align-top text-center">
                                        <span
                                            class="inline-block px-3 py-1 text-[10px] font-bold rounded-full border 
                                            {{ $donor->status === 'Diterima'
                                                ? 'bg-emerald-50 text-emerald-600 border-emerald-100'
                                                : ($donor->status === 'Ditolak'
                                                    ? 'bg-slate-100 text-slate-800 border-slate-200'
                                                    : 'bg-amber-50 text-amber-600 border-amber-100') }}">
                                            {{ $donor->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-5 align-top text-center">
                                        @if ($donor->status === 'Proses')
                                            <a href="{{ route('admin.seleksi-donor', $donor->daftardonor_id) }}"
                                                class="p-2 bg-rose-50 text-rose-600 rounded-lg border border-rose-100 hover:bg-rose-100 transition-colors shadow-sm flex items-center justify-center mx-auto"
                                                title="Seleksi Donor">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.1c-2.8 4.3-5.2 8.7-5.2 12.1 0 2.9 2.3 5.3 5.2 5.3s5.2-2.4 5.2-5.3c0-3.4-2.4-7.8-5.2-12.1z" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="text-slate-300">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-5 align-top text-center">
                                        <button class="p-2 text-rose-400 hover:text-rose-600 transition-colors"
                                            title="Batal Donor">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14"
                                        class="px-6 py-12 text-center text-slate-500 font-medium bg-slate-50/20">
                                        Tidak ada data donor ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <!-- jQuery and DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Flatpickr
                flatpickr("#tgl_pendaftaran", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d/m/Y",
                    allowInput: true,
                    locale: {
                        rangeSeparator: ' ~ '
                    }
                });

                // Initialize DataTables
                $('#donorTable').DataTable({
                    "pageLength": 10,
                    "ordering": false,
                    "info": true,
                    "searching": false,
                    "scrollX": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json",
                        "paginate": {
                            "previous": "<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'></path></svg>",
                            "next": "<svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'></path></svg>"
                        }
                    },
                    "dom": 'rt<"flex flex-col md:flex-row justify-between items-center gap-4 mt-4"ip>',
                    "columnDefs": [{
                        "targets": [0, 5, 8, 10, 11, 12, 13],
                        "orderable": false
                    }]
                });
            });
        </script>
        <style>
            /* DataTables Custom Styling */
            .dataTables_wrapper .dataTables_paginate {
                padding-top: 0;
                display: flex;
                gap: 0.25rem;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.5rem 1rem !important;
                margin: 0 !important;
                border-radius: 0.5rem !important;
                border: 1px solid #e2e8f0 !important;
                background: white !important;
                color: #64748b !important;
                font-size: 0.875rem !important;
                font-weight: 600 !important;
                transition: all 0.2s !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background: #e11d48 !important;
                border-color: #e11d48 !important;
                color: white !important;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
                background: #fff1f2 !important;
                border-color: #fda4af !important;
                color: #e11d48 !important;
            }

            .dataTables_wrapper .dataTables_info {
                color: #64748b !important;
                font-size: 0.875rem !important;
                font-weight: 500 !important;
            }

            table.dataTable thead th {
                border-bottom: 1px solid #f1f5f9 !important;
            }

            table.dataTable.no-footer {
                border-bottom: none !important;
            }

            .dataTables_scrollBody {
                border-bottom: 1px solid #f1f5f9 !important;
            }

            .flatpickr-days {
                width: 100% !important;
                display: flex;
                justify-content: center;
            }

            .flatpickr-day.selected {
                background: #e11d48 !important;
                border-color: #e11d48 !important;
            }

            .flatpickr-day.today {
                border-color: #e11d48 !important;
                color: #e11d48 !important;
            }
        </style>
    @endpush
</x-app-layout>
