<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;

    public function masged () {
        return $this->belongsTo(Masged::class, 'masged_id', 'id');
    }

    public function students () {
        return $this->hasMany(Student::class, 'circle_id', 'id');
    }

    public function qurans () {
        return $this->hasMany(Quran::class, 'circle_id', 'id');
    }
}
