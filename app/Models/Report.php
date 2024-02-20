<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "post_id",
        "alasan",
    ] ;

    public function users(){
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function posts(){
        return $this->belongsTo(Post::class,"post_id","id");
    }
}
