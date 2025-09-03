<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPulang extends Model
{
    use HasFactory;

    protected $table = 'surat_pulangs'; // Optional, bisa dihapus jika pakai nama default

    protected $fillable = [
        'penempatan_kamar_id',
        'pendaftaran_igd_id',
        'tanggal_pulang',
        'diagnosa',
        'tindakan',
        'nama_petugas',
        'nip_petugas',
    ];

    // Relasi ke PenempatanKamar    
   public function penempatanKamar()
{
    return $this->belongsTo(\App\Models\PenempatanKamar::class);
}
    public function pendaftaranIgd()
    {
        return $this->belongsTo(PendaftaranIgd::class, 'pendaftaran_igd_id');
    }
    // Aksesors untuk tanggal_pulang
    protected $casts = [
        'tanggal_pulang' => 'datetime',
    ];
    
    public function getTanggalPulangAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s') : null;
    }
    public function setTanggalPulangAttribute($value)
    {
        $this->attributes['tanggal_pulang'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
    public function getNoSuratAttribute()
    {
        return 'SP-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }
    public function pasien()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien ?? null;
    }
    public function getNoRekamMedisAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->no_rekam_medis ?? '-';
    }
    public function getKamarAttribute()
    {
        return $this->penempatanKamar->kamar ?? null;
    }
    public function getKelasAttribute()
    {
        return $this->penempatanKamar->kamar->kelas ?? null;
    }
    public function getPetugasAttribute()
    {
        return $this->suratPulang->nama_petugas ?? null;
    }
    
    public function getNipPetugasAttribute()
    {
        return $this->suratPulang->nip_petugas ?? null;
    }
    public function getTanggalMasukAttribute()
    {
        return $this->penempatanKamar->tanggal_masuk ? \Carbon\Carbon::parse($this->penempatanKamar->tanggal_masuk)->format('d-m-Y H:i:s') : null;
    }
    public function getTanggalKeluarAttribute()
    {
        return $this->penempatanKamar->pendaftaranIgd->tanggal_keluar ? \Carbon\Carbon::parse($this->penempatanKamar->pendaftaranIgd->tanggal_keluar)->format('d-m-Y H:i:s') : null;
    }
    public function getTanggalLahirAttribute()
    {               
        return $this->penempatanKamar->permintaanRawatInap->pasien->tanggal_lahir ? \Carbon\Carbon::parse($this->penempatanKamar->permintaanRawatInap->pasien->tanggal_lahir)->format('d-m-Y') : null;
    }       
    public function getJenisKelaminAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->jenis_kelamin ?? '-';
    }   
    public function getAlamatAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->alamat ?? '-';
    }
    public function getNoTelpAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->no_telp ?? '-';
    }
    public function getStatusAttribute()
    {
        return $this->penempatanKamar->status ?? 'Belum Ditempatkan';
    }
    public function getJenisPembayaranAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->jenis_pembayaran ?? 'Umum';
    }   
    public function getNamaPasienAttribute()
    {
        return $this->penempatanKamar->permintaanRawatInap->pasien->nama ?? 'Tidak Diketahui';
    }
}
