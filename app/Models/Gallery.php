<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'pictures', 'description', 'user_id'];

    protected $casts = [
        'pictures' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
