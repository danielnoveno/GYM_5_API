<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTrainer extends Model
{
    use HasFactory;
    protected $table = 'review_trainers';

    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_trainer',
        'id_pelanggan',
        'tanggal_review',
        'review',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
