<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomorindukpegawai' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nomorindukpegawai.required' => 'Nomor Induk Pegawai (NIP) wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $nip = trim((string) $this->input('nomorindukpegawai'));
        $password = (string) $this->input('password');

        $pegawai = \App\Models\Pegawai::where('nomorindukpegawai', $nip)->first();

        if (! $pegawai) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nomorindukpegawai' => 'Nomor Induk Pegawai (NIP) tidak terdaftar.',
            ]);
        }

        $user = \App\Models\User::where('pegawai_id', $pegawai->pegawai_id)->first();

        if (! $user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nomorindukpegawai' => 'Nomor Induk Pegawai (NIP) tidak terdaftar.',
            ]);
        }

        if (! $user->statusaktif) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nomorindukpegawai' => 'Akun pegawai ini sedang tidak aktif.',
            ]);
        }

        if (! Auth::attempt(['pegawai_id' => $user->pegawai_id, 'password' => $password], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Password yang Anda masukkan salah.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'nomorindukpegawai' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower((string) $this->input('nomorindukpegawai')).'|'.$this->ip());
    }
}
