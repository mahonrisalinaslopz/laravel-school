<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(SemesterSeeder::class);
        $this->call(CareerSeeder::class);
        $this->call(CourseSeeder::class);
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
        ]);

        $user = User::factory()->create([
            'email' => 'admin@admin.com',
        ])->assignRole('admin');

        DB::table('teachers')->insert([
            "user_id" => $user->id,
            "name" => "Admin",
            "last_name" => "Test",
            "phone" => fake()->phoneNumber(),
        ]);

        Teacher::factory(4)->create();
        Student::factory(10)->create();
    }
}
