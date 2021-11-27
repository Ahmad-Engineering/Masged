<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
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
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'email'=>$this->faker->email,
            'phone'=>$this->faker->phoneNumber(),
            'age'=>$this->faker->numberBetween(17, 80),
            'gender'=>$this->faker->boolean(),
            'active'=>$this->faker->boolean()
        ];
    }
}
