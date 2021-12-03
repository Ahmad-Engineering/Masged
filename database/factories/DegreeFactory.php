<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class DegreeFactory extends Factory
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
            'degree'=>$this->faker->numberBetween(1, 100),
            'course_name'=> Course::inRandomOrder()->first()->name,
            'student_id'=> Student::inRandomOrder()->first()->id,
        ];
    }
}
