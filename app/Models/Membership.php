<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'memberships';
    protected $primaryKey = 'id_membership';
    protected $fillable = [
        'id_pelanggan',
        'id_jenis_membership',
        'jenis_membership',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function jenisMembership()
    {
        return $this->belongsTo(JenisMembership::class, 'id_jenis_membership');
    }
}
