<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function students () {
        return $this->hasMany(StudentCourse::class, 'course_id', 'id');
    }

    public function teachers () {
        return $this->hasMany(TeacherCourse::class, 'course_id', 'id');
    }

    public function masged() {
        return $this->belongsTo(Masged::class, 'masged_name', 'name');
    }

    public function marks () {
        return $this->hasMany(Mark::class, 'course_id', 'id');
    }
}
