<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    protected $primaryKey = 'id_trainer';

    protected $fillable = [
        'title',
        'duration',
        'imagePath',
        'email',
        'description',
        'specialization',
        'price',
        'id_paket_personal_trainer'
    ];

    /**
     * Relasi ke PersonalTrainer.
     */
    // public function personalTrainer()
    // {
    //     return $this->belongsTo(PersonalTrainer::class, 'id_paket_personal_trainer');
    // }
}
