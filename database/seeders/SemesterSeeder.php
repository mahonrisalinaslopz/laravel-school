<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [["Semestre 1", "Inicio de curso aprenderas conceptos basicos"], ["Semestre 2", "Continuas con tu crecimiento basico"], ["Semestre 3", "Comienzas con tus cursos medios"], ["Semestre 4", "Continuas con tu crecimiento medio"], ["Semestre 5", "Inicias tus cursos avanzados"], ["Semestre 6", "Continuas con tu crecimiento Avnzado"], ["Semestre 7", "Inicioas tus proyectos finales"], ["Semestre 8", "Ultimo empujon para graduar"],];
        foreach ($semesters as $semester) {
            Semester::create([
                "name" => $semester[0],
                "description" => $semester[1]
            ]);
        }
    }
}
