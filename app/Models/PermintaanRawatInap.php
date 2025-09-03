<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanRawatInap extends Model
{
    use HasFactory;

    // Jika nama table beda dari default (permintaan_rawat_inaps), definisikan:
    // protected $table = 'permintaan_rawat_inap';

    protected $fillable = [
        'pendaftaran_igd_id',
        'waktu_permintaan',
        'status',
        'catatan',
    ];

    protected $casts = [
        'waktu_permintaan' => 'datetime',
    ];

    // Relasi ke pendaftaran IGD
    public function pendaftaranIgd()
{
    return $this->belongsTo(PendaftaranIgd::class);
}

    // Relasi ke pasien
    public function pasien()
{
    return $this->hasOneThrough(Pasien::class, PendaftaranIgd::class, 'id', 'id', 'pendaftaran_igd_id', 'pasiens_id');

}
    // Relasi ke penempatan kamar
    public function penempatanKamar()
{
    return $this->hasMany(PenempatanKamar::class);
}

    // Relasi ke kamar
    public function kamar()
{
    return $this->hasOneThrough(Kamar::class, PenempatanKamar::class, 'permintaan_rawat_inap_id', 'id', 'id', 'kamar_id');
}
    // Relasi ke dokter
    public function dokter()
{
    return $this->belongsTo(Dokter::class, 'dokter_id');    

}
    // Aksesors untuk status
    public function getStatusAttribute()
{
    return $this->attributes['status'] ?? 'Belum Ditempatkan';
}

    // Aksesors untuk waktu permintaan
    public function getWaktuPermintaanAttribute($value)
{
    return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s') : null;
}

    public function setWaktuPermintaanAttribute($value)
{
    $this->attributes['waktu_permintaan'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
}
    // Aksesors untuk catatan
    public function getCatatanAttribute($value)
{
    return $value ?: 'Tidak ada catatan';
}

    public function setCatatanAttribute($value)
{
    $this->attributes['catatan'] = $value ?: 'Tidak ada catatan';
}
public function cetakSurat($id)
{
    $record = PermintaanRawatInap::findOrFail($id);

    return view('pdf.surat-permintaan', compact('record'));
}
}