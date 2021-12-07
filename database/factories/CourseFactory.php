<?php

namespace Database\Factories;

use App\Models\Masged;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
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
            'name'=>$this->faker->word(),
            'info'=>$this->faker->word(),
            'status' => $this->faker->boolean(),
            'masged_name' => Masged::inRandomOrder()->first()->name,
        ];
    }
}
