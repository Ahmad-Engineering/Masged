<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MasgedFactory extends Factory
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
            'name'=>$this->faker->name,
            'info'=>$this->faker->word,
            'location'=>$this->faker->word
        ];
    }
}
