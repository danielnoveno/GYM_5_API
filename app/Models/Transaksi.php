<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'tanggal_transaksi',
        'jumlah_transaksi',
        'metode_pembayaran',
        'status_pembayaran',
        'id_layanan',
        'id_detail_transaksi',
    ];

    // Relasi dengan Pelanggan (1-N)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Relasi dengan Layanan (1-N)
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    // Relasi dengan DetailTransaksi (1-N)
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}