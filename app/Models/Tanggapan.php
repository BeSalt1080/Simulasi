<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{

    use HasFactory;
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        "pengaduan_id",
        "user_id",
        "pesan",
    ];
}
