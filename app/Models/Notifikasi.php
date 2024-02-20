<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        "from",
        "to",
        "post_id" ,
        "msg",
        "status",
    ] ;

    // Relasi untuk pengirim notifikasi
    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }

    // Relasi untuk penerima notifikasi
    public function recipient()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
