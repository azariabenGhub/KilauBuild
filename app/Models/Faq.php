<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'user_id'
    ];

    public function searchAuthor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
