<?php

namespace Database\Factories;

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
            'status' => $this->faker->randomElement(['Done', 'Waiting']),
        ];
    }
}
