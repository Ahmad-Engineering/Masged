<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Queue\Console\RetryBatchCommand;

class Student extends Authenticatable
{
    use HasFactory;

    public function masged () {
        return $this->belongsTo(Masged::class, 'masged_name', 'name');
    }

    public function degrees () {
        return $this->hasMany(Degree::class, 'student_id', 'id');
    }

    public function courses () {
        return $this->hasMany(StudentCourse::class, 'student_id', 'id');
    }

    public function teachers () {
        return $this->hasMany(StudentTeacher::class, 'student_id', 'id');
    }

    public function marks () {
        return $this->hasMany(Mark::class, 'student_id', 'id');
    }

    public function circle () {
        return $this->belongsTo(Circle::class, 'circle_id', 'id');
    }

    public function qurans () {
        return $this->hasMany(Quran::class, 'quran_id', 'id');
    }
}
