<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pasien;

class PendaftaranIGD extends Model
{
    protected $table = 'pendaftaran_igds'; // Gunakan nama tabel tanpa auto-plural
    protected $guarded = [];
    protected $fillable = [
        'pasiens_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'waktu_pendaftaran',
        'status',
    ];
    

    public function pasien()
    {
         return $this->belongsTo(Pasien::class, 'pasiens_id');
    }
    public function permintaanRawatInap()
    {
        return $this->hasMany(PermintaanRawatInap::class, 'pendaftaran_igd_id');
    }
    public function penempatanKamar()
    {
        return $this->hasMany(PenempatanKamar::class, 'pendaftaran_igd_id');
    }
    public function kamar()
    {
        return $this->hasManyThrough(Kamar::class, PenempatanKamar::class, 'pendaftaran_igd_id', 'id', 'id', 'kamar_id');
    }
    public function getStatusAttribute()
    {
        return $this->attributes['status'] ?? 'Belum Ditempatkan';
    }
    public function getTanggalMasukAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }
    public function setTanggalMasukAttribute($value)
    {
        $this->attributes['tanggal_masuk'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
    public function getTanggalKeluarAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }
    public function setTanggalKeluarAttribute($value)
    {
        $this->attributes['tanggal_keluar'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
    public function getWaktuPendaftaranAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }
    public function setWaktuPendaftaranAttribute($value)
    {
        $this->attributes['waktu_pendaftaran'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
    public function getTanggalLahirAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y') : null;
    }
    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? \Carbon\Carbon::parse ($value)->format('Y-m-d') : null;   
    }
    public function getJenisKelaminAttribute($value)
    {
        return $value ? ucfirst($value) : 'Tidak Diketahui';
    }
    
    
        
    
}