<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'tanggal',
        'waktu',
        'id_ruangan',
        'id_trainer',
        'id_pelanggan',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }

    public function kelasOlahraga()
    {
        return $this->belongsToMany(KelasOlahraga::class, 'jadwal_kelas', 'id_jadwal', 'id_kelas');
    }
}
