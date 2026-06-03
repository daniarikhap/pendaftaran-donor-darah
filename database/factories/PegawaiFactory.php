<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition(): array
    {
        return [
            'nama_pegawai' => fake()->name(),
            'noidentitas' => fake()->unique()->numerify('################'),
            'nomorindukpegawai' => fake()->unique()->numerify('19#########'),
            'is_admin' => false,
        ];
    }
}
