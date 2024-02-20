<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'wallpaper',
    ] ;

    
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class,'album_id','id');
    }
}

