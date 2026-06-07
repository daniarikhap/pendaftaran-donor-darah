<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KuesionerDonor extends Model
{
    use HasFactory;

    protected $table = 'kuesionerdonor';
    protected $primaryKey = 'kuesionerdonor_id';

    protected $fillable = [
        'kuesioner_urutan',
        'kuesioner_desc',
        'kuesioner_aktif',
        'jawaban_lolos',
        'create_time',
        'update_time',
        'create_loginpemakai_id',
        'update_loginpemakai_id',
        'create_ruangan',
    ];

    protected $casts = [
        'kuesioner_aktif' => 'boolean',
        'jawaban_lolos' => 'boolean',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];
}
