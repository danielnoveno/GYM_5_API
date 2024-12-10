<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatGym extends Model
{
    use HasFactory;
    protected $table = 'alat_gyms';
    protected $primaryKey = 'id_alat';
    protected $fillable = [
        'image_path',
        'nama_alat',
        'deskripsi',
        'harga',
    ];
}
