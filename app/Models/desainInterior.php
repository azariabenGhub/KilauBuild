<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class desainInterior extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'user_id'
    ];
}
