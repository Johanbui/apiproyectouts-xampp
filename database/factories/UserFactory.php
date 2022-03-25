<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gender = rand(1,2);
        return [
            'name' => $this->faker->name(),
            'last_name'=>$this->faker->lastname(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make("Uts2022"), // password
            'remember_token' => Str::random(10),
            'avatar'=> ($gender==1)? 'https://randomuser.me/api/portraits/men/89.jpg':'https://randomuser.me/api/portraits/women/89.jpg' ,
            'gender' => $gender,
            'enable' => 1,
            'rol_id' =>rand(2, 4)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
