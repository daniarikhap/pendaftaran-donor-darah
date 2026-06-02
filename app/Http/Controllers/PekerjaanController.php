<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PekerjaanController extends Controller
{
    /**
     * Menampilkan daftar pekerjaan dengan filter pencarian dan status.
     */
    public function index(Request $request): View
    {
        $query = Pekerjaan::query();

        // Filter berdasarkan pencarian nama pekerjaan
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('pekerjaan_nama', 'like', $searchTerm);
        }

        // Filter berdasarkan status aktif
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->where('pekerjaan_aktif', true);
            } elseif ($request->status === 'tidak_aktif') {
                $query->where('pekerjaan_aktif', false);
            }
        }

        // Urutkan berdasarkan nama pekerjaan
        $pekerjaans = $query->orderBy('pekerjaan_nama', 'asc')->get();

        return view('pekerjaan.index', compact('pekerjaans'));
    }

    /**
     * Menampilkan form untuk menambah data pekerjaan.
     */
    public function create(): View
    {
        return view('pekerjaan.create');
    }

    /**
     * Menyimpan data pekerjaan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pekerjaan_nama' => 'required|string|max:255',
        ], [
            'pekerjaan_nama.required' => 'Nama pekerjaan wajib diisi.',
            'pekerjaan_nama.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        Pekerjaan::create([
            'pekerjaan_nama' => $request->pekerjaan_nama,
            'pekerjaan_aktif' => true, // Default aktif saat baru dibuat
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengubah data pekerjaan.
     */
    public function edit($id): View
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        return view('pekerjaan.edit', compact('pekerjaan'));
    }

    /**
     * Memperbarui data pekerjaan di database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'pekerjaan_nama' => 'required|string|max:255',
            'pekerjaan_aktif' => 'nullable|boolean',
        ], [
            'pekerjaan_nama.required' => 'Nama pekerjaan wajib diisi.',
            'pekerjaan_nama.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        $pekerjaan = Pekerjaan::findOrFail($id);

        $pekerjaan->update([
            'pekerjaan_nama' => $request->pekerjaan_nama,
            'pekerjaan_aktif' => $request->has('pekerjaan_aktif'),
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil diperbarui!');
    }

    /**
     * Menghapus data pekerjaan dari database.
     */
    public function destroy($id): RedirectResponse
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil dihapus!');
    }
}
