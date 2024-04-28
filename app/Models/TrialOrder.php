<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrialOrder extends Model
{
    use HasFactory;
    protected $table = 'trial_order';

    protected $fillable = [
        'set_number',
        'photo1_path',
        'photo2_path',
        'pairing_type',
        'taken',
    ];
}
