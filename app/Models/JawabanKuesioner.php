<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JawabanKuesioner extends Model
{
    use HasFactory;

    protected $table = 'jawaban_kuesioner';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'seleksidonor_id',
        'daftardonor_id',
        'kuesionerdonor_id',
        'ceklist',
    ];

    protected $casts = [
        'ceklist' => 'boolean',
    ];

    public function seleksidonor(): BelongsTo
    {
        return $this->belongsTo(SeleksiDonor::class, 'seleksidonor_id', 'seleksidonor_id');
    }

    public function daftardonor(): BelongsTo
    {
        return $this->belongsTo(PendaftaranDonor::class, 'daftardonor_id', 'daftardonor_id');
    }

    public function kuesionerdonor(): BelongsTo
    {
        return $this->belongsTo(KuesionerDonor::class, 'kuesionerdonor_id', 'kuesionerdonor_id');
    }
}
