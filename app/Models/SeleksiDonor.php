<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeleksiDonor extends Model
{
    use HasFactory;

    protected $table = 'seleksidonor';
    protected $primaryKey = 'seleksidonor_id';

    protected $fillable = [
        'daftardonor_id',
        'pegawai_id',
        'pendonor_id',
        'tglseleksidonor',
        'jenisdonor',
        'tekanandarah',
        'td_systolic',
        'td_diastoliic',
        'detaknadi',
        'is_gagalseleksi',
    ];

    protected $casts = [
        'tglseleksidonor' => 'datetime',
        'is_gagalseleksi' => 'boolean',
    ];

    public function daftardonor(): BelongsTo
    {
        return $this->belongsTo(PendaftaranDonor::class, 'daftardonor_id', 'daftardonor_id');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'pegawai_id');
    }

    public function pendonor(): BelongsTo
    {
        return $this->belongsTo(Pendonor::class, 'pendonor_id', 'pendonor_id');
    }
}
