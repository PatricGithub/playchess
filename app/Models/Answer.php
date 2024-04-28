<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'validated_code',
        'photo1_path',
        'photo2_path',
        'condition',
        'reaction_time',
        'description',
        'pairing_type',
        'likert',
    ];
}
