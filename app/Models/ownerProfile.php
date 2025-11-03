<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ownerProfile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'desc',
        'image',
        'url_instagram',
        'url_linkedin',
        'user_id'
    ];
}
