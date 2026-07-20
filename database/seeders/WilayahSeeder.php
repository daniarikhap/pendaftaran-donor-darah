<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Seed Provinsi
        $this->command->info('Seeding Provinsi...');
        $filePath = database_path('data/provinces.csv');
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle, 0, ';'); // Skip header
            $data = [];
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 2) continue;
                $data[] = [
                    'id' => (int) $row[0],
                    'nama' => trim($row[1], '" '),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            fclose($handle);
            foreach (array_chunk($data, 100) as $chunk) {
                DB::table('provinsi')->insert($chunk);
            }
        }

        // 2. Seed Kabupaten
        $this->command->info('Seeding Kabupaten...');
        $filePath = database_path('data/regencies.csv');
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle, 0, ';'); // Skip header
            $data = [];
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 3) continue;
                $data[] = [
                    'id' => (int) $row[0],
                    'provinsi_id' => (int) $row[1],
                    'nama' => trim($row[2], '" '),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            fclose($handle);
            foreach (array_chunk($data, 200) as $chunk) {
                DB::table('kabupaten')->insert($chunk);
            }
        }

        // 3. Seed Kecamatan
        $this->command->info('Seeding Kecamatan...');
        $filePath = database_path('data/districts.csv');
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle, 0, ';'); // Skip header
            $data = [];
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 3) continue;
                $data[] = [
                    'id' => (int) $row[0],
                    'kabupaten_id' => (int) $row[1],
                    'nama' => trim($row[2], '" '),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            fclose($handle);
            foreach (array_chunk($data, 500) as $chunk) {
                DB::table('kecamatan')->insert($chunk);
            }
        }

        // 4. Seed Kelurahan
        $this->command->info('Seeding Kelurahan...');
        $filePath = database_path('data/villages.csv');
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle, 0, ';'); // Skip header
            $data = [];
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 3) continue;
                $data[] = [
                    'id' => (int) $row[0],
                    'kecamatan_id' => (int) $row[1],
                    'nama' => trim($row[2], '" '),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            fclose($handle);
            foreach (array_chunk($data, 2000) as $chunk) {
                DB::table('kelurahan')->insert($chunk);
            }
        }

        $this->command->info('Seeding wilayah selesai!');
    }
}
