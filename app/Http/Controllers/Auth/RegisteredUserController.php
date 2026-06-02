<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pegawai_nama' => ['required', 'string', 'max:255'],
            'nomoridentitas' => ['required', 'string', 'max:255'],
            'nomorindukpegawai' => ['required', 'string', 'max:255', 'unique:master_pegawai,nomorindukpegawai'],
            'username' => ['required', 'string', 'max:255', 'unique:login_user,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'pegawai_nama.required' => 'Nama Lengkap Pegawai wajib diisi.',
            'nomoridentitas.required' => 'Nomor Identitas (NIK) wajib diisi.',
            'nomorindukpegawai.required' => 'Nomor Induk Pegawai (NIP) wajib diisi.',
            'nomorindukpegawai.unique' => 'Nomor Induk Pegawai (NIP) sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'password.required' => 'Kata Sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok.',
        ]);

        $user = DB::transaction(function () use ($request) {
            $pegawai = Pegawai::create([
                'pegawai_nama' => $request->pegawai_nama,
                'nomoridentitas' => $request->nomoridentitas,
                'nomorindukpegawai' => $request->nomorindukpegawai,
            ]);

            return User::create([
                'pegawai_id' => $pegawai->pegawai_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'statusaktif' => true,
            ]);
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))->with('success', 'Registrasi berhasil, selamat datang!');
    }
}
