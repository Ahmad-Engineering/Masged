<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masged extends Model
{
    use HasFactory;

    public function students () {
        return $this->hasMany(Student::class, 'masged_name', 'name');
    }

    public function manager () {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function teachers () {
        return $this->hasMany(Teacher::class, 'masged_id', 'id');
    }

    public function courses () {
        return $this->hasMany(Course::class , 'masged_name', 'name');
    }

    public function circles () {
        return $this->hasMany(Circle::class, 'masged_id', 'id');
    }
}
