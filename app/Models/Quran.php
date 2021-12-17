<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    use HasFactory;

    public function circle () {
        return $this->belongsTo(Circle::class, 'circle_id', 'id');
    }

    public function student () {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

}
