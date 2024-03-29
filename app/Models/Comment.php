<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'gallery_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gallery(){
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
