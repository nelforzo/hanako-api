<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuffTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stuff_id',
        'tag'
    ];
}
