<?php

namespace Database\Factories;

use App\Models\Quran;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuranStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'student_id' => Student::inRandomOrder()->first()->id,
            'quran_id' => Quran::inRandomOrder()->first()->id
        ];
    }
}
