<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMembership extends Model
{
    use HasFactory;

    protected $table = 'jenis_memberships';
    protected $primaryKey = 'id_jenis_membership';

    protected $fillable = [
        'membership_title',
        'type',
        'description',
        'price',
        'total',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_title', 'title');
    }
}
