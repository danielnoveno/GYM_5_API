<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'umur',
        'alamat',
        'no_telepon',
        'email',
        'tanggal_daftar',
        'id_jadwal'
    ];

    // Relasi dengan Membership
    public function membership()
    {
        return $this->hasOne(Membership::class, 'id_pelanggan');
    }

    // Relasi dengan PersonalTrainer
    public function personalTrainer()
    {
        return $this->hasOne(PersonalTrainer::class, 'id_pelanggan');
    }

    // Relasi dengan AlatGym
    public function alatGym()
    {
        return $this->hasMany(AlatGym::class, 'id_pelanggan');
    }

    // Relasi dengan KelasOlahraga
    public function kelasOlahraga()
    {
        return $this->hasMany(KelasOlahraga::class, 'id_pelanggan');
    }

    // Relasi dengan Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }

    // Relasi dengan ReviewTrainer
    public function reviewTrainer()
    {
        return $this->hasMany(ReviewTrainer::class, 'id_pelanggan');
    }

    // Relasi dengan Riwayat
    public function riwayat()
    {
        return $this->hasMany(Riwayat::class, 'id_pelanggan');
    }
}
