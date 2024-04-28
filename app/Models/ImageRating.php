<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'rating',
        'answer',
        'participant_id',
        'expertise',
    ];
}
