<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendonor extends Model
{
    use HasFactory;

    protected $table = 'pendonor';
    protected $primaryKey = 'pendonor_id';

    protected $fillable = [
        'no_pendonor',
        'jenisidentitas',
        'no_identitas',
        'nama_lengkap',
        'tempat_lahir',
        'tgllahir',
        'jenis_kelamin',
        'alamat_lengkap',
        'beratbadan_kg',
        'tinggibadan_cm',
        'notelp_pendonor',
        'nomobile_pendonor',
        'pekerjaan_id',
        'statusperkawinan',
        'gol_darah',
        'rhesus',
        'is_pernah_donor',
        'donasi_ke_sblm',
        'tgl_donor_terakhir',
        'tempat_donor_terakhir',
        'donasi_ke',
        'create_time',
        'update_time',
        'create_loginpemakai_id',
        'update_loginpemakai_id',
        'create_ruangan',
        'pegawai_id',
        'propinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'agama',
    ];

    protected $casts = [
        'tgllahir' => 'date',
    ];

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(PendaftaranDonor::class, 'pendonor_id', 'pendonor_id');
    }

    public function seleksiDonors(): HasMany
    {
        return $this->hasMany(SeleksiDonor::class, 'pendonor_id', 'pendonor_id');
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'pegawai_id');
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'pekerjaan_id');
    }
}
