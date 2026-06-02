<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $pegawai = \App\Models\Pegawai::factory()->create([
            'pegawai_nama' => 'Admin',
            'nomoridentitas' => '12345678',
            'nomorindukpegawai' => '12345678',
        ]);

        User::factory()->create([
            'pegawai_id' => $pegawai->pegawai_id,
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'statusaktif' => true,
        ]);

        // Seed Pekerjaan
        $pekerjaans = [
            ['pekerjaan_nama' => 'Pegawai Swasta', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'PNS / ASN', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'Wiraswasta', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'Pelajar / Mahasiswa', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'Buruh', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'Ibu Rumah Tangga', 'pekerjaan_aktif' => true],
            ['pekerjaan_nama' => 'Lainnya', 'pekerjaan_aktif' => true],
        ];
        foreach ($pekerjaans as $p) {
            \App\Models\Pekerjaan::create($p);
        }

        // Seed Ruangan
        \App\Models\Ruangan::create([
            'ruangan_nama' => 'Unit Transfusi Darah Utama',
            'ruangan_singkatan' => 'UTD Main',
            'pekerjaan_aktif' => true,
        ]);

        // Seed a sample Pendonor for "Pendonor Lama" testing
        \App\Models\Pendonor::create([
            'pegawai_id' => $pegawai->pegawai_id,
            'pekerjaan_id' => 1, // Pegawai Swasta
            'no_pendonor' => 'PD-0001',
            'jenisidentitas' => 'NIK',
            'no_identitas' => '3201234567890001',
            'nama_lengkap' => 'Budi Santoso',
            'tempat_lahir' => 'Jakarta',
            'tgllahir' => '1990-05-15',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Jl. Mawar No. 12, Jakarta',
        ]);
    }
}
