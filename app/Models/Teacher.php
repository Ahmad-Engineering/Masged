<?php

namespace App\Models;

// use GuzzleHttp\Psr7\AppendStream;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $appends = ['status'];

    public function courses () {
        return $this->hasMany(TeacherCourse::class, 'teacher_id', 'id');
    }

    public function students () {
        return $this->hasMany(StudentTeacher::class, 'teacher_id', 'id');
    }

    function getStatusAttribute() {
        if ($this->active) {
            return 'Active';
        }else{
            return 'Disabled';
        }
    }

    // function getSexAttribute() {
    //     if($this->gender) {
    //         return 'Male';
    //     }else{
    //         return 'Female';
    //     }
    // }
}
