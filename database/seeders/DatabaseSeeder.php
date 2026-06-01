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
    }
}
