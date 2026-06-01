<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'master_pegawai';
    protected $primaryKey = 'pegawai_id';

    protected $fillable = [
        'pegawai_nama',
        'nomoridentitas',
        'nomorindukpegawai',
    ];

    public function loginUsers(): HasMany
    {
        return $this->hasMany(User::class, 'pegawai_id', 'pegawai_id');
    }
}
