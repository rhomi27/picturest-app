<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use App\Models\Album;
use App\Models\Follow;
use App\Models\Report;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'alamat',
        'nama_lengkap',
        'pictures',
        'bio',
        'jenis_kelamin',
        'tanggal_lahir',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function albums(){
        return $this->hasMany(Album::class);
    }
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'user_id')->withTimestamps();
    }
    
}
