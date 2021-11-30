<?php

namespace Database\Factories;

use App\Models\Masged;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
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
            'masged_id' => Masged::inRandomOrder()->first()->id,
            'email'=>$this->faker->email(),
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'phone'=>$this->faker->phoneNumber(),
            'parent_phone'=>$this->faker->phoneNumber(),
            'age'=>$this->faker->numberBetween(5, 70),
            'status'=>$this->faker->boolean(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
        ];
    }
}
