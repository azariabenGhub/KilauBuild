<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ongoingProjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'loc',
        'image',
        'persen',
        'user_id'
    ];

    public function searchAuthor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
