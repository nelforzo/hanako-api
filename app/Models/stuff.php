<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'brand',
        'barcode',
        'uuid',
        'units_per_package',
        'mililiters_per_package',
        'expiration_date',
        'opened_date',
        'consume_before_days'
    ];
}
