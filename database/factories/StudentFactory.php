<?php

namespace Database\Factories;

use App\Models\Masged;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'masged_name' => Masged::inRandomOrder()->first()->name,
            'email'=>$this->faker->email(),
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'phone'=>$this->faker->phoneNumber(),
            'parent_phone'=>$this->faker->phoneNumber(),
            'password' => Hash::make('password'),
            'age'=>$this->faker->numberBetween(5, 70),
            'status'=>$this->faker->boolean(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
        ];
    }
}
