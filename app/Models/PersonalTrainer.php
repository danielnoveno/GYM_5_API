<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTrainer extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'trainers'; 

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'title',
        'duration',
        'image_path',
        'email',
        'description',
        'specialization',
        'price',
        'id_paket_personal_trainer',
    ];

    public function personalTrainer()
    {
        return $this->belongsTo(PersonalTrainer::class, 'id_paket_personal_trainer');
    }
}
