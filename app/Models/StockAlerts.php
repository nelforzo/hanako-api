<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAlerts extends Model
{
    use HasFactory;

    protected $fillable = [
        'stuff_id',
        'minumum_level',
        'comment'
    ];
}
