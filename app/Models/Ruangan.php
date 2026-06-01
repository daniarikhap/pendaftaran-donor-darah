<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'master_ruangan';
    protected $primaryKey = 'ruangan_id';

    protected $fillable = [
        'ruangan_nama',
        'ruangan_singkatan',
        'pekerjaan_aktif',
    ];

    protected $casts = [
        'pekerjaan_aktif' => 'boolean',
    ];
}
