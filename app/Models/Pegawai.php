<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'master_pegawai';
    protected $primaryKey = 'pegawai_id';

    protected $fillable = [
        'loginuser_id',
        'nama_pegawai',
        'jenisidentitas',
        'noidentitas',
        'nomorindukpegawai',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'tempatlahir_pegawai',
        'tgl_lahirpegawai',
        'jeniskelamin',
        'statusperkawinan',
        'alamat_pegawai',
        'agama',
        'golongandarah',
        'rhesus',
        'alamatemail',
        'notelp_pegawai',
        'nomobile_pegawai',
        'warganegara_pegawai',
        'tinggibadan',
        'beratbadan',
        'pegawai_aktif',
        'is_admin',
    ];

    public function loginUsers(): HasMany
    {
        return $this->hasMany(User::class, 'pegawai_id', 'pegawai_id');
    }

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }
}
