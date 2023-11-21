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
                "name" => "2022/2023 Gasal",
                "start_date" => '2022-09-05 00:00:00',
                "end_date" => '2022-12-24 00:00:00',
            ],
            [
                "name" => "2022/2023 Genap",
                "start_date" => '2023-02-06 00:00:00',
                "end_date" => '2023-07-08 00:00:00',
            ],
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
