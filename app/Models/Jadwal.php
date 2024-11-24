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
        'bulan',
        'tahun',
        'waktu',
        'id_ruangan',
        'id_trainer',
    ];

    // Relasi dengan Ruangan (1-1)
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    // Relasi dengan Trainer (1-N)
    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }

    // Relasi dengan KelasOlahraga (N-N)
    public function kelasOlahraga()
    {
        return $this->belongsToMany(KelasOlahraga::class, 'jadwal_kelas', 'id_jadwal', 'id_kelas');
    }
}
