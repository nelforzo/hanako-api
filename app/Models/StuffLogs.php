<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuffLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation',
        'stuff_id',
        'user_id'
    ];
}
