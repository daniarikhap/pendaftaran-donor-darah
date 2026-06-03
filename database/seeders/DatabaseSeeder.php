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
            'nama_pegawai' => 'Admin',
            'noidentitas' => '12345678',
            'nomorindukpegawai' => '12345678',
            'is_admin' => true,
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
    }
}
