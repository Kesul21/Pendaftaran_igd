<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenempatanKamar extends Model
{
    protected $fillable = [
        'permintaan_rawat_inap_id',
        'nama_pasien',
        'kamar_id',
        'nomor_tempat_tidur',
        'tanggal_masuk',
        'status',
    ];

    protected static function booted()
{
    static::created(function ($penempatan) {
        // Kurangi kapasitas tersedia saat pasien ditempatkan
        if ($penempatan->kamar && $penempatan->kamar->kapasitas_tersedia > 0) {
            $penempatan->kamar->decrement('kapasitas_tersedia');
        }
    });

    static::updated(function ($penempatan) {
        // Jika status diubah jadi "Selesai", tambah kapasitas tersedia
        if ($penempatan->isDirty('status') && $penempatan->status === 'Selesai') {
            if ($penempatan->kamar && $penempatan->kamar->kapasitas_tersedia < $penempatan->kamar->kapasitas) {
                $penempatan->kamar->increment('kapasitas_tersedia');
            }
        }
    });

    static::deleted(function ($penempatan) {
        // Jika penempatan dihapus dan statusnya belum "Selesai", kembalikan kapasitas
        if ($penempatan->status === 'Aktif') {
            $penempatan->kamar->increment('kapasitas_tersedia');
        }
    });
    static::saved(function ($penempatan) {
        if ($penempatan->status === 'Selesai' && $penempatan->permintaanRawatInap) {
            $penempatan->permintaanRawatInap->status = 'Disetujui'; // atau 'Selesai' sesuai sistem kamu
            $penempatan->permintaanRawatInap->save();
        }
    });
}


    public function permintaanRawatInap()
    {
        return $this->belongsTo(PermintaanRawatInap::class);
    }
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
    
    public function pasien()
    {
         return $this->belongsTo(Pasien::class, 'pasiens_id');
    }
    public function pendaftaranIgd()
    {
        return $this->belongsTo(PendaftaranIgd::class);
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
    public function getNamaPasienAttribute($value)
    {
        return $value ?: 'Tidak Diketahui'; 
}
public function suratPulang()
{
    return $this->hasOne(SuratPulang::class);
}
}