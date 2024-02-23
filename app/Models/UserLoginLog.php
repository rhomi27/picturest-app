<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLoginLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "login_time",
        "ip_address",
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
