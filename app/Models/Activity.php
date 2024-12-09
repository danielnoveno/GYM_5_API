<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'created_at',
        'finish_at',
        'date'
    ];

    protected $dates = [
        'created_at',
        'finish_at'
    ];
}
