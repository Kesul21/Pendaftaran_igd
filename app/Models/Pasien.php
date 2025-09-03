<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens'; // Optional, bisa dihapus jika pakai nama default

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'jenis_pembayaran',
    ];
    protected static function booted()
{
    static::creating(function ($pasien) {
        $latest = self::latest('id')->first();
        $number = $latest ? (intval(substr($latest->no_rekam_medis, -4)) + 1) : 1;
        $prefix = 'RM-' . now()->format('Ym') . '-';
        $pasien->no_rekam_medis = $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    });
}
    
public function pendaftaranIgds()
    {
        return $this->hasMany(PendaftaranIGD::class, 'pasiens_id');
    }

}
