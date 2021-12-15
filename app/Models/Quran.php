<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    use HasFactory;

    public function students () {
        return $this->hasMany(QuranStudent::class, 'quran_id', 'id');
    }

    public function circle () {
        return $this->belongsTo(Circle::class, 'circle_id', 'id');
    }
}
