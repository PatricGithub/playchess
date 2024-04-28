<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'ranking',
        'age',
        'age_started',
        'gender',
        'frequency_playing',
        'unique_id',
        'expertise',
    ];
}
