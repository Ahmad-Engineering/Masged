<?php

namespace Database\Factories;

use App\Models\Masged;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagerFactory extends Factory
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
            'email'=>$this->faker->email(),
            'gender'=>$this->faker->randomElement(['Male', 'Female']),
            'age'=>$this->faker->numberBetween(17, 80),
            'phone'=>$this->faker->phoneNumber(),
            'status'=>$this->faker->randomElement(['Active', 'Disabled']),
            'masged_id' => Masged::inRandomOrder()->first()->id,
        ];
    }
}
