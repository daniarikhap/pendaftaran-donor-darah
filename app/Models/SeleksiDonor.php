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
        'td_systolic',
        'td_diastoliic',
        'kadar_hb',
        'suhu_tubuh',
        'detaknadi',
        'gol_darah',
        'rhesus',
        'alasan_ditolak',
        'bb_rendah',
        'usia_kurang',
        'hb_rendah',
        'medis_lain',
        'medis_tk_tinggi',
        'medis_td_rendah',
        'minum_obat',
        'medis_pasca_op',
        'medis_hb_17',
        'medis_vaksin',
        'medis_bb_lebih',
        'perilakuberesiko',
        'perilakuberesiko_homo',
        'perilakuberesiko_tatto',
        'perilakuberesiko_freesx',
        'perilakuberesiko_penasun',
        'perilakuberesiko_napi',
        'riwberpergian',
        'riwbepergian_endemik',
        'riwbepergian_hiv',
        'riwbepergian_sapigila',
        'lain_lain',
        'lain_lain_tdkkembali',
        'lain_lain_donortua',
        'catatan_dokter',
    ];

    protected $casts = [
        'tglseleksidonor' => 'datetime',
        'alasan_ditolak' => 'boolean',
        'bb_rendah' => 'boolean',
        'usia_kurang' => 'boolean',
        'hb_rendah' => 'boolean',
        'medis_lain' => 'boolean',
        'medis_tk_tinggi' => 'boolean',
        'medis_td_rendah' => 'boolean',
        'minum_obat' => 'boolean',
        'medis_pasca_op' => 'boolean',
        'medis_hb_17' => 'boolean',
        'medis_vaksin' => 'boolean',
        'medis_bb_lebih' => 'boolean',
        'perilakuberesiko' => 'boolean',
        'perilakuberesiko_homo' => 'boolean',
        'perilakuberesiko_tatto' => 'boolean',
        'perilakuberesiko_freesx' => 'boolean',
        'perilakuberesiko_penasun' => 'boolean',
        'perilakuberesiko_napi' => 'boolean',
        'riwberpergian' => 'boolean',
        'riwbepergian_endemik' => 'boolean',
        'riwbepergian_hiv' => 'boolean',
        'riwbepergian_sapigila' => 'boolean',
        'lain_lain' => 'boolean',
        'lain_lain_tdkkembali' => 'boolean',
        'lain_lain_donortua' => 'boolean',
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
