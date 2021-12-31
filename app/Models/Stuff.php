<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    use HasFactory;

    protected $table = 'stuff';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'active_package_id',
        'show_in_auto_list'
    ];
}
