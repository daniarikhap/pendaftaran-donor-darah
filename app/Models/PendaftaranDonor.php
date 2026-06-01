<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranDonor extends Model
{
    use HasFactory;

    protected $table = 'daftardonor';
    protected $primaryKey = 'daftardonor_id';

    protected $fillable = [
        'pendonor_id',
        'ruangan_id',
        'no_formulir',
        'nama_petugas_id',
        'keterangan_donasi',
        'donasi_ke',
        'create_time',
        'update_time',
        'ruangan_rekruitmen_id',
        'waktu_pendaftaran',
        'status',
        'beratbadan_kg',
        'tinggibadan_cm',
    ];

    protected $casts = [
        'create_time' => 'datetime',
        'update_time' => 'datetime',
        'waktu_pendaftaran' => 'datetime',
    ];

    public function pendonor(): BelongsTo
    {
        return $this->belongsTo(Pendonor::class, 'pendonor_id', 'pendonor_id');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'ruangan_id');
    }
}
