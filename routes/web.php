<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Pendonor;
use App\Models\KuesionerDonor;

use App\Models\Pekerjaan;
use App\Models\PendaftaranDonor;
use App\Models\SeleksiDonor;

Route::get('/', function () {
    $pekerjaans = Pekerjaan::where('pekerjaan_aktif', true)->get();
    $pendonors = Pendonor::withCount(['seleksiDonors as total_donor_diterima' => function ($query) {
        $query->where('status_donor_kunjungan', 'Donor Berhasil');
    }])->withMax(['seleksiDonors as tgl_donor_terakhir' => function ($query) {
        $query->where('status_donor_kunjungan', 'Donor Berhasil');
    }], 'tanggal_donor_berhasil')
    ->withExists(['pendaftarans as has_active_registration' => function ($query) {
        $query->where('status', 'Proses')->where('bataldonordarah', false);
    }])->get();
    $provinsis = \App\Models\Provinsi::all();
    $ruangans = Ruangan::all();
    $kuesioners = KuesionerDonor::where('kuesioner_aktif', true)->orderBy('kuesioner_urutan', 'asc')->get();
    
    return view('pendaftaran-donordarah.Pendonor.welcome', compact('pekerjaans', 'pendonors', 'provinsis', 'ruangans', 'kuesioners'));
});

Route::post('/pendonor', [\App\Http\Controllers\PendonorController::class, 'store'])->name('pendonor.store');
Route::post('/daftar-donor', [\App\Http\Controllers\PendonorController::class, 'daftarDonor'])->name('daftardonor.store');
Route::put('/pendonor/{id}', [\App\Http\Controllers\PendonorController::class, 'update'])->name('pendonor.update');
Route::get('/api/kabupaten/{provinsi_id}', [\App\Http\Controllers\PendonorController::class, 'getKabupaten']);
Route::get('/api/kecamatan/{kabupaten_id}', [\App\Http\Controllers\PendonorController::class, 'getKecamatan']);
Route::get('/api/kelurahan/{kecamatan_id}', [\App\Http\Controllers\PendonorController::class, 'getKelurahan']);
Route::get('/api/riwayat-donor', [\App\Http\Controllers\PendonorController::class, 'getRiwayatDonor']);
Route::post('/api/verify-pegawai', [\App\Http\Controllers\PendonorController::class, 'verifyPegawai']);

Route::get('/dashboard', function () {
    $totalDonor = PendaftaranDonor::count();
    $donorBerhasil = SeleksiDonor::where('status_donor_kunjungan', 'Donor Berhasil')->count();
    $jumlahPendonor = Pendonor::count();
    $jumlahKuesioner = KuesionerDonor::count();

    return view('pendaftaran-donordarah.Admin.dashboard', compact('totalDonor', 'donorBerhasil', 'jumlahPendonor', 'jumlahKuesioner'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kuesioner CRUD
    Route::resource('kuesioner', \App\Http\Controllers\KuesionerController::class)->except(['show']);

    // Ruangan CRUD
    Route::resource('ruangan', \App\Http\Controllers\RuanganController::class)->except(['show']);

    // Pekerjaan CRUD
    Route::resource('pekerjaan', \App\Http\Controllers\PekerjaanController::class)->except(['show']);

    // Data Donor (Admin)
    Route::get('/admin/data-donor', [\App\Http\Controllers\PendonorController::class, 'indexAdmin'])->name('admin.data-donor');
    Route::get('/admin/seleksi-donor/{id}', [\App\Http\Controllers\PendonorController::class, 'seleksiDonor'])->name('admin.seleksi-donor');
    Route::post('/admin/seleksi-donor/{id}', [\App\Http\Controllers\PendonorController::class, 'storeSeleksi'])->name('admin.seleksi-donor.store');
    Route::post('/admin/seleksi-donor/{id}/konfirmasi', [\App\Http\Controllers\PendonorController::class, 'konfirmasiDonor'])->name('admin.seleksi-donor.konfirmasi');
    Route::post('/admin/seleksi-donor/{id}/batal', [\App\Http\Controllers\PendonorController::class, 'batalKunjunganDonor'])->name('admin.seleksi-donor.batal');
    Route::post('/admin/batal-donor/{id}', [\App\Http\Controllers\PendonorController::class, 'batalDonor'])->name('admin.batal-donor');
});

require __DIR__.'/auth.php';
