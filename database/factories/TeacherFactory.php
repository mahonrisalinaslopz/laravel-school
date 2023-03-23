<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $admin = User::factory()->create()->assignRole()

        $user = User::factory()->create()->assignRole('teacher');

        return [
            "user_id" => $user->id,
            "name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "phone" => fake()->phoneNumber(),
        ];
    }
}
