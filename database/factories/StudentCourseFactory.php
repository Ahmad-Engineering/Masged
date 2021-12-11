<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentCourseFactory extends Factory
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
            'student_id'=> Student::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'course_name' => Course::inRandomOrder()->first()->name,
        ];
    }
}
