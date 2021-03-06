<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Manager extends Authenticatable
{
    use HasFactory;

    public function masged () {
        return $this->hasOne(Masged::class, 'manager_id', 'id');
    }
}
