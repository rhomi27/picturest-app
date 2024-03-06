<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use Ramsey\Uuid\Uuid;
use App\Models\Report;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'album_id',
        'judul',
        'deskripsi',
        'tag',
        'file', 
        'status',
    ] ;

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
        $model->uuid = $model->uuid ?: Uuid::uuid4()->toString();
       }); 
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function albums(){
        return $this->belongsTo(Album::class,'album_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function reports(){
        return $this->hasMany(Report::class,'post_id','id');
    }
}
