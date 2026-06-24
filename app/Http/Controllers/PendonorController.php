<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendonor;
use App\Models\SeleksiDonor;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\PendaftaranDonor;
use App\Models\JawabanKuesioner;
use App\Models\KuesionerDonor;

class PendonorController extends Controller
{
    /**
     * Store a new donor registration.
     */
    public function daftarDonor(Request $request)
    {
        $validated = $request->validate([
            'pendonor_id' => 'required|exists:pendonor,pendonor_id',
            'tgl_pendaftaran' => 'required|string',
            'tinggibadan_cm' => 'required|numeric',
            'beratbadan_kg' => 'required|numeric',
            'ruangan_id' => 'required|exists:master_ruangan,ruangan_id',
            'jawaban' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $pendonor = Pendonor::findOrFail($validated['pendonor_id']);

            // 1. Generate no_formulir: PDH + Ymd + 00001
            $today = date('Ymd');
            $prefix = 'PDH' . $today;
            $latest = PendaftaranDonor::where('no_formulir', 'like', $prefix . '%')
                ->orderBy('no_formulir', 'desc')
                ->first();

            if ($latest) {
                $lastSeq = substr($latest->no_formulir, strlen($prefix));
                $sequence = intval($lastSeq) + 1;
            } else {
                $sequence = 1;
            }
            $no_formulir = $prefix . str_pad($sequence, 5, '0', STR_PAD_LEFT);

            // 2. Calculate donasi_ke
            $previousDonationsCount = PendaftaranDonor::where('pendonor_id', $pendonor->pendonor_id)->count();
            $donasi_ke = $previousDonationsCount + 1;

            // 3. Determine status based on questionnaire
            // Rule: Compare donor's answer with jawaban_lolos in kuesionerdonor table
            $isSeleksi = true;
            $kuesioners = KuesionerDonor::whereIn('kuesionerdonor_id', array_keys($validated['jawaban']))
                ->get();

            foreach ($kuesioners as $k) {
                $jawabanDonor = $validated['jawaban'][$k->kuesionerdonor_id];

                // Compare with jawaban_lolos (match both as integer/boolean)
                if ((int)$jawabanDonor !== (int)$k->jawaban_lolos) {
                    $isSeleksi = false;
                    break;
                }
            }
            $status = $isSeleksi ? 'Proses' : 'Ditolak';

            // 4. Parse pendaftaran date
            $waktu_pendaftaran = date('Y-m-d H:i:s', strtotime($validated['tgl_pendaftaran']));

            // 5. Create PendaftaranDonor
            $pendaftaran = new PendaftaranDonor();
            $pendaftaran->pendonor_id = $pendonor->pendonor_id;
            $pendaftaran->no_formulir = $no_formulir;
            $pendaftaran->nama_petugas = 'Online'; // Hardcoded as requested
            $pendaftaran->donasi_ke = $donasi_ke;
            $pendaftaran->create_ruangan = $validated['ruangan_id'];
            $pendaftaran->ruangan_rekruitmen_id = $validated['ruangan_id'];
            $pendaftaran->ruangan_id = $validated['ruangan_id'];
            $pendaftaran->status = $status;
            $pendaftaran->gol_darah = $pendonor->gol_darah;
            $pendaftaran->rhesus = $pendonor->rhesus;
            $pendaftaran->beratbadan_kg = $validated['beratbadan_kg'];
            $pendaftaran->tinggibadan_cm = $validated['tinggibadan_cm'];
            $pendaftaran->waktu_pendaftaran = $waktu_pendaftaran;
            $pendaftaran->create_time = now();
            $pendaftaran->save();

            // 6. Save Questionnaire Answers
            foreach ($validated['jawaban'] as $kuesioner_id => $ceklist) {
                $jawabanModel = new JawabanKuesioner();
                $jawabanModel->daftardonor_id = $pendaftaran->daftardonor_id;
                $jawabanModel->kuesionerdonor_id = $kuesioner_id;
                $jawabanModel->ceklist = $ceklist;
                $jawabanModel->save();
            }

            DB::commit();

            // Fetch fresh pendonor data with aggregates to update frontend state
            $pendonorFresh = Pendonor::withCount(['seleksiDonors as total_donor_diterima' => function ($query) {
                $query->where('status_donor_kunjungan', 'Donor Berhasil');
            }])->withMax(['seleksiDonors as tgl_donor_terakhir' => function ($query) {
                $query->where('status_donor_kunjungan', 'Donor Berhasil');
            }], 'tanggal_donor_berhasil')
                ->withExists(['pendaftarans as has_active_registration' => function ($query) {
                    $query->where('status', 'Proses')->where('bataldonordarah', false);
                }])->findOrFail($pendonor->pendonor_id);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran Donor Berhasil!',
                'data' => $pendaftaran,
                'pendonor' => $pendonorFresh
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in daftarDonor: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan pendaftaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created pendonor in storage.
     */
    public function store(Request $request)
    {
        if ($request->filled('no_identitas')) {
            $exists = Pendonor::where('no_identitas', $request->input('no_identitas'))->exists();
            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda Tidak Bisa Mendaftar, Karena Sudah Pernah Melakukan Daftar Sebelumnya.'
                ], 422);
            }
        }

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

        // Refresh to get counts and max date
        $pendonor = Pendonor::withCount(['seleksiDonors as total_donor_diterima' => function ($query) {
            $query->where('status_donor_kunjungan', 'Donor Berhasil');
        }])->withMax(['seleksiDonors as tgl_donor_terakhir' => function ($query) {
            $query->where('status_donor_kunjungan', 'Donor Berhasil');
        }], 'tanggal_donor_berhasil')
            ->withExists(['pendaftarans as has_active_registration' => function ($query) {
                $query->where('status', 'Proses')->where('bataldonordarah', false);
            }])->findOrFail($pendonor->pendonor_id);

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

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Akun pengguna untuk pegawai ini belum dibuat.'
            ], 404);
        }

        if (!\Illuminate\Support\Facades\Hash::check($validated['password'], $user->password) && $validated['password'] !== $user->password) {
            return response()->json([
                'success' => false,
                'message' => 'Password yang Anda masukkan salah.'
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
            'gol_darah' => 'nullable|string|max:5',
            'rhesus' => 'nullable|string|max:10',
        ]);

        try {
            // Find by primary key (pendonor_id) or by no_pendonor
            $pendonor = Pendonor::where('pendonor_id', $id)
                ->orWhere('no_pendonor', $id)
                ->firstOrFail();

            $pendonor->nama_lengkap = $validated['nama_lengkap'];
            $pendonor->alamat_lengkap = $validated['alamat_lengkap'];
            $pendonor->nomobile_pendonor = $validated['nomobile_pendonor'];
            $pendonor->gol_darah = $request->input('gol_darah') ?: null;
            $pendonor->rhesus = $request->input('rhesus') ?: null;
            $pendonor->save();

            // Refresh to get counts and max date
            $pendonor = Pendonor::withCount(['seleksiDonors as total_donor_diterima' => function ($query) {
                $query->where('status_donor_kunjungan', 'Donor Berhasil');
            }])->withMax(['seleksiDonors as tgl_donor_terakhir' => function ($query) {
                $query->where('status_donor_kunjungan', 'Donor Berhasil');
            }], 'tanggal_donor_berhasil')
                ->withExists(['pendaftarans as has_active_registration' => function ($query) {
                    $query->where('status', 'Proses')->where('bataldonordarah', false);
                }])->findOrFail($pendonor->pendonor_id);

            return response()->json([
                'success' => true,
                'message' => 'Profil Berhasil Diperbarui!',
                'data' => $pendonor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
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

    /**
     * Get donor history.
     */
    public function getRiwayatDonor(Request $request)
    {
        $validated = $request->validate([
            'pendonor_id' => 'required|exists:pendonor,pendonor_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $start = date('Y-m-d 00:00:00', strtotime($validated['start_date']));
        $end = date('Y-m-d 23:59:59', strtotime($validated['end_date']));

        $riwayat = PendaftaranDonor::with('ruanganRekruitmen')
            ->where('pendonor_id', $validated['pendonor_id'])
            ->whereBetween('waktu_pendaftaran', [$start, $end])
            ->orderBy('waktu_pendaftaran', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $riwayat
        ]);
    }

    /**
     * Display a listing of donor registrations for admin.
     */
    public function indexAdmin(Request $request)
    {
        $query = PendaftaranDonor::with(['pendonor', 'ruanganRekruitmen', 'seleksiDonor']);

        if ($request->filled('tgl_pendaftaran')) {
            // Handle range separator ' ~ ' (custom) or ' to ' (default flatpickr)
            $dateString = $request->tgl_pendaftaran;
            $dates = preg_split('/ (to|~) /', $dateString);

            if (count($dates) === 2) {
                $query->whereBetween('waktu_pendaftaran', [
                    trim($dates[0]) . ' 00:00:00',
                    trim($dates[1]) . ' 23:59:59'
                ]);
            } else {
                $query->whereDate('waktu_pendaftaran', trim($dates[0]));
            }
        }

        if ($request->filled('no_formulir')) {
            $query->where('no_formulir', 'like', '%' . $request->no_formulir . '%');
        }

        if ($request->filled('no_pendonor')) {
            $query->whereHas('pendonor', function ($q) use ($request) {
                $q->where('no_pendonor', 'like', '%' . $request->no_pendonor . '%');
            });
        }

        if ($request->filled('nama_pendonor')) {
            $query->whereHas('pendonor', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->nama_pendonor . '%');
            });
        }

        $daftarDonors = $query->orderBy('daftardonor_id', 'desc')->get();

        return view('pendaftaran-donordarah.Admin.data-donor', compact('daftarDonors'));
    }

    /**
     * Display the seleksi donor page.
     */
    public function seleksiDonor($id)
    {
        $donor = PendaftaranDonor::with(['pendonor', 'ruanganRekruitmen', 'seleksiDonor'])->findOrFail($id);

        // Get last successful donor history
        $riwayatTerakhir = PendaftaranDonor::where('pendonor_id', $donor->pendonor_id)
            ->where('status', 'Diterima')
            ->where('daftardonor_id', '!=', $id)
            ->orderBy('waktu_pendaftaran', 'desc')
            ->first();

        // Get questionnaire answers
        $jawabanKuesioner = JawabanKuesioner::with('kuesionerdonor')
            ->where('daftardonor_id', $id)
            ->get()
            ->sortBy(function ($jawaban) {
                return $jawaban->kuesionerdonor->kuesioner_urutan;
            });

        return view('pendaftaran-donordarah.Admin.seleksi-donor', compact('donor', 'jawabanKuesioner', 'riwayatTerakhir'));
    }

    /**
     * Store the seleksi donor data.
     */
    public function storeSeleksi(Request $request, $id)
    {
        $donor = PendaftaranDonor::findOrFail($id);

        $request->validate([
            'jenis_donor' => 'required',
            'tensi_sistole' => 'required',
            'tensi_diastole' => 'required',
            'kadar_hb' => 'required',
            'suhu_tubuh' => 'required',
            'denyut_nadi' => 'required',
            'gol_darah' => 'required',
            'rhesus' => 'required',
            'tgl_seleksi' => 'required|date',
        ]);

        $isDitolak = $request->has('is_ditolak');

        if ($isDitolak) {
            $alasan = $request->input('alasan', []);
            $hasAlasan = !empty($alasan) ||
                $request->has('alasan_medis_active') ||
                $request->has('alasan_resiko_active') ||
                $request->has('alasan_bepergian_active') ||
                $request->has('alasan_lain_active');

            if (!$hasAlasan) {
                return back()->withInput()->withErrors(['is_ditolak' => 'silahkan isi terlebih dahulu alasan ditolak atau gagal']);
            }
        }

        $alasanArray = $request->input('alasan', []);
        $statusKunjungan = $isDitolak ? 'Ditolak' : 'Siap Donor';

        SeleksiDonor::create([
            'daftardonor_id' => $donor->daftardonor_id,
            'pendonor_id' => $donor->pendonor_id,
            'pegawai_id' => Auth::id(), // Assuming logged in user is the officer
            'tglseleksidonor' => $request->tgl_seleksi,
            'jenisdonor' => $request->jenis_donor,
            'td_systolic' => $request->tensi_sistole,
            'td_diastoliic' => $request->tensi_diastole,
            'kadar_hb' => $request->kadar_hb,
            'suhu_tubuh' => $request->suhu_tubuh,
            'detaknadi' => $request->denyut_nadi,
            'gol_darah' => $request->gol_darah,
            'rhesus' => $request->rhesus,
            'alasan_ditolak' => $isDitolak,
            'bb_rendah' => in_array('BB < 45Kg', $alasanArray),
            'usia_kurang' => in_array('Usia < 17 Tahun', $alasanArray),
            'hb_rendah' => in_array('HB <', $alasanArray),
            'medis_lain' => $request->has('alasan_medis_active'),
            'medis_tk_tinggi' => $request->alasan_medis == 'Hipertensi',
            'medis_td_rendah' => $request->alasan_medis == 'Hipotensi',
            'minum_obat' => $request->alasan_medis == 'Minum Obat',
            'medis_pasca_op' => $request->alasan_medis == 'Pasca Op',
            'medis_hb_17' => $request->alasan_medis == 'HB > 17,0 gr %',
            'medis_vaksin' => $request->alasan_medis == 'Sakit / vaksin / haid / busui',
            'medis_bb_lebih' => $request->alasan_medis == 'BB >=',
            'perilakuberesiko' => $request->has('alasan_resiko_active'),
            'perilakuberesiko_homo' => $request->alasan_resiko == 'Homo',
            'perilakuberesiko_tatto' => $request->alasan_resiko == 'Tato',
            'perilakuberesiko_freesx' => $request->alasan_resiko == 'Free Sex',
            'perilakuberesiko_penasun' => $request->alasan_resiko == 'Penasun',
            'perilakuberesiko_napi' => $request->alasan_resiko == 'Napi',
            'riwberpergian' => $request->has('alasan_bepergian_active'),
            'riwbepergian_endemik' => $request->alasan_bepergian == 'Daerah Endemik',
            'riwbepergian_hiv' => $request->alasan_bepergian == 'Negara dg Kasus HIV',
            'riwbepergian_sapigila' => $request->alasan_bepergian == 'Negara dg Kasus Sapi Gila',
            'lain_lain' => $request->has('alasan_lain_active'),
            'lain_lain_tdkkembali' => $request->alasan_lain == 'Tidak Kembali',
            'lain_lain_donortua' => $request->alasan_lain == 'Donor Pertama Usia > 65Th',
            'catatan_dokter' => $request->catatan_dokter,
            'status_donor_kunjungan' => $statusKunjungan,
        ]);

        // Update status in daftardonor table
        $donor->status = $statusKunjungan;
        $donor->save();

        if ($statusKunjungan === 'Siap Donor') {
            return redirect()->route('admin.seleksi-donor', $id)->with('success', 'Seleksi donor berhasil disimpan.');
        }

        return redirect()->route('admin.data-donor')->with('success', 'Seleksi donor berhasil disimpan.');
    }

    /**
     * Confirm that the donor succeeded.
     */
    public function konfirmasiDonor($id)
    {
        $donor = PendaftaranDonor::findOrFail($id);
        $seleksi = SeleksiDonor::where('daftardonor_id', $id)->firstOrFail();

        $seleksi->status_donor_kunjungan = 'Donor Berhasil';
        $seleksi->tanggal_donor_berhasil = now();
        $seleksi->save();

        $donor->status = 'Diterima';
        $donor->save();

        return redirect()->route('admin.data-donor')->with('success', 'Donor darah berhasil dikonfirmasi.');
    }

    /**
     * Cancel the donor visit.
     */
    public function batalKunjunganDonor(Request $request, $id)
    {
        $request->validate([
            'keterangan_donor' => 'required|string',
        ]);

        $donor = PendaftaranDonor::findOrFail($id);
        $seleksi = SeleksiDonor::where('daftardonor_id', $id)->firstOrFail();

        $seleksi->status_donor_kunjungan = 'Batal Donor';
        $seleksi->keterangan_donor = $request->keterangan_donor;
        $seleksi->save();

        $donor->bataldonordarah = true;
        $donor->status = 'Dibatalkan';
        $donor->save();

        return redirect()->route('admin.data-donor')->with('success', 'Donor darah berhasil dibatalkan.');
    }

    /**
     * Cancel the donor registration.
     */
    public function batalDonor($id)
    {
        try {
            $donor = PendaftaranDonor::findOrFail($id);

            // Only allow cancellation if status is still 'Proses' (Antrian)
            if ($donor->status !== 'Proses') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya data dengan status Antrian yang dapat dibatalkan.'
                ], 422);
            }

            $donor->bataldonordarah = true;
            $donor->save();

            return response()->json([
                'success' => true,
                'message' => 'Data donor berhasil dibatalkan.',
                'data' => $donor
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan data donor.'
            ], 500);
        }
    }
}
