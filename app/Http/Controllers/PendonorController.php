<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendonor;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendonorController extends Controller
{
    /**
     * Store a newly created pendonor in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'jenisidentitas' => 'required|string',
            'no_identitas' => 'required|string',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgllahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pekerjaan_id' => 'required|exists:master_pekerjaan,pekerjaan_id',
            'agama' => 'required|string',
            'statusperkawinan' => 'required|string',
            'gol_darah' => 'required|string',
            'rhesus' => 'required|string',
            'tinggibadan_cm' => 'required|numeric',
            'beratbadan_kg' => 'required|numeric',
            'alamat_lengkap' => 'required|string',
            'propinsi_id' => 'required|exists:provinsi,id',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kelurahan_id' => 'required|exists:kelurahan,id',
            'no_mobile' => 'required|string',
            'pegawai_id' => 'nullable|exists:master_pegawai,pegawai_id',
        ];

        // Relax validation constraints if registering an employee (some fields might be null/empty in master_pegawai)
        if ($request->has('pegawai_id') && !empty($request->input('pegawai_id'))) {
            $rules['tempat_lahir'] = 'nullable|string|max:255';
            $rules['tgllahir'] = 'nullable|date';
            $rules['jenis_kelamin'] = 'nullable|string';
            $rules['agama'] = 'nullable|string';
            $rules['statusperkawinan'] = 'nullable|string';
            $rules['gol_darah'] = 'nullable|string';
            $rules['rhesus'] = 'nullable|string';
            $rules['propinsi_id'] = 'nullable|exists:provinsi,id';
            $rules['kabupaten_id'] = 'nullable|exists:kabupaten,id';
            $rules['kecamatan_id'] = 'nullable|exists:kecamatan,id';
            $rules['kelurahan_id'] = 'nullable|exists:kelurahan,id';
        }

        $validated = $request->validate($rules);

        // Generate automatic no_pendonor: UTD + Ymd + 5 digit counter
        $todayStr = date('Ymd');
        $prefix = 'UTD' . $todayStr;

        $latest = Pendonor::where('no_pendonor', 'like', $prefix . '%')
            ->orderBy('no_pendonor', 'desc')
            ->first();

        if ($latest) {
            $lastSeq = substr($latest->no_pendonor, strlen($prefix));
            $sequence = intval($lastSeq) + 1;
        } else {
            $sequence = 1;
        }

        $no_pendonor = $prefix . str_pad($sequence, 5, '0', STR_PAD_LEFT);

        // Map inputs to DB column names
        $pendonor = new Pendonor();
        $pendonor->no_pendonor = $no_pendonor;
        $pendonor->jenisidentitas = $validated['jenisidentitas'];
        $pendonor->no_identitas = $validated['no_identitas'];
        $pendonor->nama_lengkap = $validated['nama_lengkap'];
        $pendonor->tempat_lahir = $validated['tempat_lahir'] ?? null;
        $pendonor->tgllahir = $validated['tgllahir'] ?? null;
        $pendonor->jenis_kelamin = $validated['jenis_kelamin'] ?? null;
        $pendonor->pekerjaan_id = $validated['pekerjaan_id'];
        $pendonor->agama = $validated['agama'] ?? null;
        $pendonor->statusperkawinan = $validated['statusperkawinan'] ?? null;
        $pendonor->gol_darah = $validated['gol_darah'] ?? null;
        $pendonor->rhesus = $validated['rhesus'] ?? null;
        $pendonor->tinggibadan_cm = $validated['tinggibadan_cm'];
        $pendonor->beratbadan_kg = $validated['beratbadan_kg'];
        $pendonor->alamat_lengkap = $validated['alamat_lengkap'];
        $pendonor->propinsi_id = $validated['propinsi_id'] ?? null; // matches propinsi_id column
        $pendonor->kabupaten_id = $validated['kabupaten_id'] ?? null;
        $pendonor->kecamatan_id = $validated['kecamatan_id'] ?? null;
        $pendonor->kelurahan_id = $validated['kelurahan_id'] ?? null;
        $pendonor->nomobile_pendonor = $validated['no_mobile']; // matches nomobile_pendonor column
        $pendonor->pegawai_id = $validated['pegawai_id'] ?? null;
        $pendonor->save();

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil!',
            'data' => $pendonor
        ]);
    }

    /**
     * Verify NIP and Password for an employee.
     */
    public function verifyPegawai(Request $request)
    {
        $validated = $request->validate([
            'nomorindukpegawai' => 'required|string',
            'password' => 'required|string',
        ]);

        $pegawai = \App\Models\Pegawai::where('nomorindukpegawai', $validated['nomorindukpegawai'])->first();
        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor Induk Pegawai (NIP) tidak terdaftar.'
            ], 404);
        }

        $user = \App\Models\User::where('pegawai_id', $pegawai->pegawai_id)->first();
        if (!$user || !\Illuminate\Support\Facades\Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah.'
            ], 401);
        }

        $pekerjaan = \App\Models\Pekerjaan::where('pekerjaan_nama', 'Pegawai Rumah Sakit')->first();

        // Standardize gender for front-end presentation
        $genderFormatted = 'Laki-laki';
        if (strtoupper($pegawai->jeniskelamin) === 'PEREMPUAN') {
            $genderFormatted = 'Perempuan';
        }

        return response()->json([
            'success' => true,
            'data' => [
                'pegawai_id' => $pegawai->pegawai_id,
                'nama' => $pegawai->nama_pegawai,
                'nik' => $pegawai->noidentitas,
                'tempat_lahir' => $pegawai->tempatlahir_pegawai,
                'tgllahir' => $pegawai->tgl_lahirpegawai,
                'jenis_kelamin' => $genderFormatted,
                'pekerjaan_id' => $pekerjaan ? $pekerjaan->pekerjaan_id : null,
                'agama' => $pegawai->agama,
                'statusperkawinan' => $pegawai->statusperkawinan,
                'gol_darah' => $pegawai->golongandarah,
                'rhesus' => $pegawai->rhesus,
                'tinggibadan' => $pegawai->tinggibadan,
                'beratbadan' => $pegawai->beratbadan,
                'provinsi_id' => $pegawai->provinsi_id,
                'kabupaten_id' => $pegawai->kabupaten_id,
                'kecamatan_id' => $pegawai->kecamatan_id,
                'kelurahan_id' => $pegawai->kelurahan_id,
                'alamat_lengkap' => $pegawai->alamat_pegawai,
                'no_mobile' => $pegawai->notelp_pegawai,
            ]
        ]);
    }

    /**
     * Update the specified pendonor.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'nomobile_pendonor' => 'required|string|max:50',
        ]);

        $pendonor = Pendonor::findOrFail($id);
        $pendonor->nama_lengkap = $validated['nama_lengkap'];
        $pendonor->alamat_lengkap = $validated['alamat_lengkap'];
        $pendonor->nomobile_pendonor = $validated['nomobile_pendonor'];
        $pendonor->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil Berhasil Diperbarui!',
            'data' => $pendonor
        ]);
    }

    /**
     * Get kabupaten by provinsi id.
     */
    public function getKabupaten($provinsi_id)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $provinsi_id)->get(['id', 'nama']);
        return response()->json($kabupaten);
    }

    /**
     * Get kecamatan by kabupaten id.
     */
    public function getKecamatan($kabupaten_id)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupaten_id)->get(['id', 'nama']);
        return response()->json($kecamatan);
    }

    /**
     * Get kelurahan by kecamatan id.
     */
    public function getKelurahan($kecamatan_id)
    {
        $kelurahan = Kelurahan::where('kecamatan_id', $kecamatan_id)->get(['id', 'nama']);
        return response()->json($kelurahan);
    }
}
