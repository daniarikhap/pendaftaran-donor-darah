<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendonor extends Model
{
    use HasFactory;

    protected $table = 'pendonor';
    protected $primaryKey = 'pendonor_id';

    protected $fillable = [
        'pegawai_id',
        'pekerjaan_id',
        'no_pendonor',
        'jenisidentitas',
        'no_identitas',
        'nama_lengkap',
        'tempat_lahir',
        'tgllahir',
        'jenis_kelamin',
        'alamat_lengkap',
    ];

    protected $casts = [
        'tgllahir' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'pegawai_id');
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'pekerjaan_id');
    }
}
