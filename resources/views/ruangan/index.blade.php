<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Kelola Master Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Panel Filter Pencarian -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6 relative">
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-slate-50/50 blur-2xl pointer-events-none"></div>
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Filter Pencarian</h3>
                
                <form method="GET" action="{{ route('ruangan.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-5">
                        <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Nama / Singkatan Ruangan</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Ketik nama atau singkatan..." 
                               class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150">
                    </div>

                    <div class="md:col-span-4">
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" id="status" 
                                class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring focus:ring-rose-200 focus:ring-opacity-50 text-sm transition duration-150">
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ request('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="md:col-span-3 flex justify-end space-x-2">
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2 px-6 rounded-xl text-sm transition duration-150 shadow-sm flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('ruangan.index') }}" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 px-6 rounded-xl text-sm transition duration-150 shadow-sm flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabel Ruangan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100 p-6">
                <div class="flex flex-row items-center justify-between mb-6 gap-4">
                    <div class="text-left">
                        <h3 class="text-lg font-bold text-slate-800">Tabel Master Ruangan</h3>
                        <p class="text-xs text-slate-500 hidden sm:block">Daftar ruangan aktif dan tidak aktif untuk tempat pendaftaran/donor.</p>
                    </div>
                    <div>
                        <a href="{{ route('ruangan.create') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition duration-150 shadow-sm whitespace-nowrap">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-xl border border-slate-100 p-1">
                    <table id="ruanganTable" class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-16 text-center">No</th>
                                <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Ruangan</th>
                                <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-40">Singkatan</th>
                                <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-32 text-center">Status</th>
                                <th class="py-4 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @php $no = 1; @endphp
                            @foreach ($ruangans as $ruangan)
                                <tr class="hover:bg-slate-50/50 transition duration-150">
                                    <td class="py-4 px-4 text-sm text-slate-600 text-center">
                                        {{ $no++ }}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-800 font-medium">
                                        {{ $ruangan->ruangan_nama }}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-600">
                                        {{ $ruangan->ruangan_singkatan }}
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($ruangan->pekerjaan_aktif)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <!-- Detail Button -->
                                            <button onclick="showDetail('{{ addslashes($ruangan->ruangan_nama) }}', '{{ addslashes($ruangan->ruangan_singkatan) }}', '{{ $ruangan->pekerjaan_aktif ? 'Aktif' : 'Tidak Aktif' }}')" 
                                                    class="p-1.5 rounded-lg bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition duration-150" 
                                                    title="Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>

                                            <!-- Edit Button -->
                                            <a href="{{ route('ruangan.edit', $ruangan->ruangan_id) }}" 
                                               class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition duration-150" 
                                               title="Ubah">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <!-- Delete Button -->
                                            <form id="delete-form-{{ $ruangan->ruangan_id }}" action="{{ route('ruangan.destroy', $ruangan->ruangan_id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $ruangan->ruangan_id }})" 
                                                        class="p-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition duration-150" 
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for SweetAlert2 notifications & DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: none !important;
        }
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        table.dataTable border-b {
            border-bottom: 1px solid rgb(241, 245, 249) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #e11d48 !important;
            color: white !important;
            border: 1px solid #e11d48 !important;
            border-radius: 8px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #fda4af !important;
            color: #9f1239 !important;
            border: 1px solid #fda4af !important;
            border-radius: 8px !important;
            color: white !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#ruanganTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "info": false,
                "language": {
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya"
                    },
                    "emptyTable": "Tidak ada data ruangan yang ditemukan."
                }
            });
        });

        function showDetail(nama, singkatan, status) {
            Swal.fire({
                title: 'Detail Ruangan',
                html: `
                    <div class="text-left space-y-3 text-sm">
                        <div>
                            <span class="font-semibold text-slate-500 block">Nama Ruangan:</span>
                            <span class="text-slate-800 font-medium">${nama}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-slate-500 block">Singkatan:</span>
                            <span class="text-slate-800 font-medium">${singkatan}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-slate-500 block">Status Keaktifan:</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold ${status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-800'}">${status}</span>
                        </div>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#1e293b',
                customClass: {
                    popup: 'rounded-2xl'
                }
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ruangan ini akan dihapus secara permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>
