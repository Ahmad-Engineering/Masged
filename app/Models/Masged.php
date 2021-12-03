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
        return $this->hasOne(Manager::class, 'Masged_id', 'id');
    }
}
