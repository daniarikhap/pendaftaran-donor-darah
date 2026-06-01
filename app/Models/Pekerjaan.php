<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'master_pekerjaan';
    protected $primaryKey = 'pekerjaan_id';

    protected $fillable = [
        'pekerjaan_nama',
        'pekerjaan_aktif',
    ];

    protected $casts = [
        'pekerjaan_aktif' => 'boolean',
    ];
}
