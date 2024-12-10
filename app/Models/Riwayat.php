<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayats';

    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'id_pelanggan',
        'tanggal_riwayat',
        'jenis_layanan',
        'total_harga',
        'image_path',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
