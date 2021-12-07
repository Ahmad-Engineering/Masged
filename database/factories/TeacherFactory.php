<?php

namespace Database\Factories;

use App\Models\Masged;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $gender = $this->faker->randomElement(['Female','Male']);
        $gender = $this->faker->randomElement([
            'Female',
            'Male'
        ]);

        return [
            //
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'email'=>$this->faker->email,
            'phone'=>$this->faker->phoneNumber(),
            'age'=>$this->faker->numberBetween(17, 80),
            // 'gender'=>$this->faker->gender,
            'password' => Hash::make('password'),
            'gender' => $gender,
            'active'=>$this->faker->boolean(),
            'masged_id' => Masged::inRandomOrder()->first()->id,
        ];
    }
}
