<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Pendonor;
use App\Models\KuesionerDonor;

use App\Models\Pekerjaan;

Route::get('/', function () {
    $pekerjaans = Pekerjaan::where('pekerjaan_aktif', true)->get();
    $pendonors = Pendonor::all();
    $provinsis = \App\Models\Provinsi::all();
    return view('pendaftaran-donordarah.Pendonor.welcome', compact('pekerjaans', 'pendonors', 'provinsis'));
});

Route::post('/pendonor', [\App\Http\Controllers\PendonorController::class, 'store'])->name('pendonor.store');
Route::put('/pendonor/{id}', [\App\Http\Controllers\PendonorController::class, 'update'])->name('pendonor.update');
Route::get('/api/kabupaten/{provinsi_id}', [\App\Http\Controllers\PendonorController::class, 'getKabupaten']);
Route::get('/api/kecamatan/{kabupaten_id}', [\App\Http\Controllers\PendonorController::class, 'getKecamatan']);
Route::get('/api/kelurahan/{kecamatan_id}', [\App\Http\Controllers\PendonorController::class, 'getKelurahan']);
Route::post('/api/verify-pegawai', [\App\Http\Controllers\PendonorController::class, 'verifyPegawai']);

Route::get('/dashboard', function () {
    $jumlahPegawai = Pegawai::count();
    $jumlahRuangan = Ruangan::count();
    $jumlahPendonor = Pendonor::count();
    $jumlahKuesioner = KuesionerDonor::count();

    return view('pendaftaran-donordarah.Admin.dashboard', compact('jumlahPegawai', 'jumlahRuangan', 'jumlahPendonor', 'jumlahKuesioner'));
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
});

require __DIR__.'/auth.php';
