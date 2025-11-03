<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class visionMission extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'visi',
        'misi',
        'user_id'
    ];
}
