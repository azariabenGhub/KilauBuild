<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstagramPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instagram_url',
        'image',
        'user_id'
    ];

    public function searchAuthor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
