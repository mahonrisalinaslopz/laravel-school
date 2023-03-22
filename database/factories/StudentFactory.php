<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create()->assignRole('student');


        return [
            "user_id" => $user->id,
            "name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "phone" => fake()->phoneNumber(),
            "official_code" => fake()->unique()->ean8(),
        ];
    }
}
