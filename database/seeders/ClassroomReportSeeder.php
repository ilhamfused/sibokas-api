<?php

namespace Database\Seeders;

use App\Models\ClassroomReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $building = [
            [
                "title" => "AC Mati",
                "description" => "AC mati coy piye kiii",
                "student_id" => 3,
                "classroom_id" => 16
            ],
            [
                "title" => "Puanasss",
                "description" => "Puanasss bangettt :((",
                "student_id" => 3,
                "classroom_id" => 17
            ],
            [
                "title" => "Kipas e tambahi",
                "description" => "Butuh kipas lebih banyak",
                "student_id" => 2,
                "classroom_id" => 16
            ],
        ];
        foreach ($building as $vendor) {
            ClassroomReport::create([
                'title' => $vendor['title'],
                'description' => $vendor['description'],
                'student_id' => $vendor['student_id'],
                'classroom_id' => $vendor['classroom_id'],
            ]);
        }
    }
}
