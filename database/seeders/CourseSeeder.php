<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ["JavaScript I", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "1"],
            ["JavaScript II", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "2"],
            ["JavaScript III", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "3"],
            ["JavaScript IV", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "4"],
            ["JavaScript V", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "5"],
            ["JavaScript VI", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "6"],
            ["JavaScript VII", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "7"],
            ["JavaScript VII", "Leguaje inicial para aprender programacion", "http://zoom.us", "1", "8"],
            ["PHP I", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "1"],
            ["PHP II", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "2"],
            ["PHP III", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "3"],
            ["PHP IV", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "4"],
            ["PHP V", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "5"],
            ["PHP VI", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "6"],
            ["PHP VII", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "7"],
            ["PHP VIII", "Leguaje inicial para aprender programacion Backend", "http://zoom.us", "2", "8"],
        ];
        foreach ($courses as $course) {
            Course::create(
                [
                    "name" => $course[0],
                    "description" => $course[1],
                    "link" => $course[2] . "/" . $course[0],
                    "career_id" => $course[3],
                    "semester_id" => $course[4]
                ]
            );
        }
    }
}
