<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pegawai_nama' => ['required', 'string', 'max:255'],
            'nomoridentitas' => ['required', 'string', 'max:255'],
            'nomorindukpegawai' => [
                'required',
                'string',
                'max:255',
                Rule::unique('master_pegawai', 'nomorindukpegawai')->ignore($this->user()->pegawai_id, 'pegawai_id'),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('login_user', 'username')->ignore($this->user()->loginuser_id, 'loginuser_id'),
            ],
        ];
    }
}
