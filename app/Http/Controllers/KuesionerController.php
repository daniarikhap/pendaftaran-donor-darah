<?php

namespace App\Http\Controllers;

use App\Models\KuesionerDonor;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KuesionerController extends Controller
{
    /**
     * Menampilkan daftar kuesioner dengan filter pencarian dan status.
     */
    public function index(Request $request): View
    {
        $query = KuesionerDonor::query();

        // Filter berdasarkan pencarian deskripsi kuesioner
        if ($request->filled('search')) {
            $query->where('kuesioner_desc', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status aktif
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->where('kuesioner_aktif', true);
            } elseif ($request->status === 'tidak_aktif') {
                $query->where('kuesioner_aktif', false);
            }
        }

        // Urutkan berdasarkan urutan kuesioner
        $kuesioners = $query->orderBy('kuesioner_urutan', 'asc')->get();

        return view('kuesioner.index', compact('kuesioners'));
    }

    /**
     * Menampilkan form untuk menambah data kuesioner.
     */
    public function create(): View
    {
        return view('kuesioner.create');
    }

    /**
     * Menyimpan data kuesioner baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kuesioner_desc' => 'required|string|max:255',
            'kuesioner_urutan' => 'required|integer|min:1',
        ], [
            'kuesioner_desc.required' => 'Deskripsi kuesioner wajib diisi.',
            'kuesioner_urutan.required' => 'Urutan kuesioner wajib diisi.',
            'kuesioner_urutan.integer' => 'Urutan kuesioner harus berupa angka.',
        ]);

        // Mengambil ID ruangan pertama yang aktif atau default ke 1
        $ruanganId = Ruangan::first()->ruangan_id ?? 1;

        KuesionerDonor::create([
            'kuesioner_desc' => $request->kuesioner_desc,
            'kuesioner_urutan' => $request->kuesioner_urutan,
            'kuesioner_aktif' => true, // Default aktif saat pertama kali dibuat
            'create_time' => now(),
            'create_loginpemakai_id' => Auth::id() ?? 1,
            'update_loginpemakai_id' => Auth::id() ?? 1,
            'create_ruangan' => $ruanganId,
        ]);

        return redirect()->route('kuesioner.index')->with('success', 'Data kuesioner berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengubah data kuesioner.
     */
    public function edit($id): View
    {
        $kuesioner = KuesionerDonor::findOrFail($id);
        return view('kuesioner.edit', compact('kuesioner'));
    }

    /**
     * Memperbarui data kuesioner di database.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'kuesioner_desc' => 'required|string|max:255',
            'kuesioner_urutan' => 'required|integer|min:1',
            'kuesioner_aktif' => 'nullable|boolean',
        ], [
            'kuesioner_desc.required' => 'Deskripsi kuesioner wajib diisi.',
            'kuesioner_urutan.required' => 'Urutan kuesioner wajib diisi.',
            'kuesioner_urutan.integer' => 'Urutan kuesioner harus berupa angka.',
        ]);

        $kuesioner = KuesionerDonor::findOrFail($id);

        $kuesioner->update([
            'kuesioner_desc' => $request->kuesioner_desc,
            'kuesioner_urutan' => $request->kuesioner_urutan,
            'kuesioner_aktif' => $request->has('kuesioner_aktif'),
            'update_time' => now(),
            'update_loginpemakai_id' => Auth::id() ?? 1,
        ]);

        return redirect()->route('kuesioner.index')->with('success', 'Data kuesioner berhasil diperbarui!');
    }

    /**
     * Menghapus data kuesioner dari database.
     */
    public function destroy($id): RedirectResponse
    {
        $kuesioner = KuesionerDonor::findOrFail($id);
        $kuesioner->delete();

        return redirect()->route('kuesioner.index')->with('success', 'Data kuesioner berhasil dihapus!');
    }
}
