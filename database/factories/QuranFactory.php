<?php

namespace Database\Factories;

use App\Models\Circle;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuranFactory extends Factory
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
            'part_no' => $this->faker->numberBetween(1, 30),
            'from_page' => $this->faker->numberBetween(1, 600),
            'to_page' => $this->faker->numberBetween(1, 600),
            'circle_id' => Circle::inRandomOrder()->first()->id,
            'student_id' => Student::inRandomOrder()->first()->id,
            // 'status' => $this->faker->randomElement(['Done', 'Waiting', 'Canceled']),
        ];
    }
}
