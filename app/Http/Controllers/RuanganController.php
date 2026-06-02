<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RuanganController extends Controller
{
    /**
     * Menampilkan daftar ruangan dengan filter pencarian dan status.
     */
    public function index(Request $request): View
    {
        $query = Ruangan::query();

        // Filter berdasarkan pencarian nama atau singkatan ruangan
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ruangan_nama', 'like', $searchTerm)
                  ->orWhere('ruangan_singkatan', 'like', $searchTerm);
            });
        }

        // Filter berdasarkan status aktif
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->where('pekerjaan_aktif', true);
            } elseif ($request->status === 'tidak_aktif') {
                $query->where('pekerjaan_aktif', false);
            }
        }

        // Urutkan berdasarkan nama ruangan
        $ruangans = $query->orderBy('ruangan_nama', 'asc')->get();

        return view('ruangan.index', compact('ruangans'));
    }

    /**
     * Menampilkan form untuk menambah data ruangan.
     */
    public function create(): View
    {
        return view('ruangan.create');
    }

    /**
     * Menyimpan data ruangan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ruangan_nama' => 'required|string|max:255',
            'ruangan_singkatan' => 'required|string|max:50',
        ], [
            'ruangan_nama.required' => 'Nama ruangan wajib diisi.',
            'ruangan_singkatan.required' => 'Singkatan ruangan wajib diisi.',
            'ruangan_singkatan.max' => 'Singkatan ruangan maksimal 50 karakter.',
        ]);

        Ruangan::create([
            'ruangan_nama' => $request->ruangan_nama,
            'ruangan_singkatan' => $request->ruangan_singkatan,
            'pekerjaan_aktif' => true, // Default aktif saat baru dibuat
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengubah data ruangan.
     */
    public function edit($id): View
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Memperbarui data ruangan di database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'ruangan_nama' => 'required|string|max:255',
            'ruangan_singkatan' => 'required|string|max:50',
            'pekerjaan_aktif' => 'nullable|boolean',
        ], [
            'ruangan_nama.required' => 'Nama ruangan wajib diisi.',
            'ruangan_singkatan.required' => 'Singkatan ruangan wajib diisi.',
            'ruangan_singkatan.max' => 'Singkatan ruangan maksimal 50 karakter.',
        ]);

        $ruangan = Ruangan::findOrFail($id);

        $ruangan->update([
            'ruangan_nama' => $request->ruangan_nama,
            'ruangan_singkatan' => $request->ruangan_singkatan,
            'pekerjaan_aktif' => $request->has('pekerjaan_aktif'),
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil diperbarui!');
    }

    /**
     * Menghapus data ruangan dari database.
     */
    public function destroy($id): RedirectResponse
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Data ruangan berhasil dihapus!');
    }
}
