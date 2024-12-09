<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasOlahraga extends Model
{
    use HasFactory;

    protected $table = 'kelas_olahragas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'judul',
        'harga',
        'image_path',
        'deskripsi',
        'id_jadwal',
        'id_ruangan',
        'id_coach',
        'kelas',
    ];

    protected $casts = [
        'deskripsi' => 'array',
        'kelas' => 'array',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id_jadwal');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'id_coach', 'id_coach');
    }
}
