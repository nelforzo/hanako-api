<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuffRatings extends Model
{
    use HasFactory;

    protected $fillable = [
        'stuff_id',
        'rating',
        'comment'
    ];
}