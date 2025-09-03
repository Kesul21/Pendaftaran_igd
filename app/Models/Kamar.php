<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kamar extends Model
{
    use HasFactory;

    // Jika tabel bernama 'kamars' (default dari Laravel), ini bisa dihapus
    protected $table = 'kamars';

    // Kolom yang bisa diisi (sesuaikan dengan form)
    protected $fillable = [
    'nama',
    'kode_kamar',
    'kelas',
    'kapasitas',
    'kapasitas_tersedia',
    ];
    // Relasi dengan PenempatanKamar
    public function penempatanKamar()
    {
        return $this->hasMany(PenempatanKamar::class); 
    }
    // Relasi dengan PermintaanRawatInap
    public function permintaanRawatInap()
    {
        return $this->hasMany(PermintaanRawatInap::class);
}
    // Relasi dengan PendaftaranIgd
    public function pendaftaranIgd()
    {
        return $this->hasMany(PendaftaranIgd::class);
    }
    // Relasi dengan Pasien
    public function pasien()
    {
        return $this->hasMany(Pasien::class);
}
}
