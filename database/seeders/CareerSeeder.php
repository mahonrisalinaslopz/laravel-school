<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Careers = [["Front-End", "Aprenderas a usar las teconologias basicas para el desarrollo de web como javascript, HTML, CSS, entre otras"], ["Back-End", "Aprenderas a usar las teconologias basicas para el desarrollo de web como PHP, Laravel"],];
        foreach ($Careers as $Career) {
            Career::create([
                "name" => $Career[0],
                "description" => $Career[1]
            ]);
        }
    }
}
