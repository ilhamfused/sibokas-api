<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semester = [
            [
                "name" => "2023/2024 Gasal",
                "start_date" => '2023-09-04 00:00:00',
                "end_date" => '2023-12-22 00:00:00',
            ],
        ];
        foreach ($semester as $vendor) {
            Semester::create([
                'name' => $vendor['name'],
                'start_date' => $vendor['start_date'],
                'end_date' => $vendor['end_date'],
            ]);
        }
    }
}
