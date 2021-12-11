<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherCourseFactory extends Factory
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
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'course_name' => Course::inRandomOrder()->first()->name,
        ];
    }
}
