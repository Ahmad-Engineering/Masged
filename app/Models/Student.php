<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function masged () {
        return $this->belongsTo(Masged::class, 'masged_id', 'id');
    }
}
