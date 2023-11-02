<?php

namespace Database\Seeders;

use App\Models\BookingClassroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $building = [
            [
                "time_in" => "09:30:00",
                "time_out" => "11:30:00",
                'status' => 2,
                'student_id' => 3,
                'classroom_id' => 1
            ],
            [
                "time_in" => "12:30:00",
                "time_out" => "15:00:00",
                'status' => 2,
                'student_id' => 3,
                'classroom_id' => 2
            ],
            [
                "time_in" => "09:30:00",
                "time_out" => "11:30:00",
                'status' => 2,
                'student_id' => 3,
                'classroom_id' => 4
            ],
        ];
        foreach ($building as $vendor) {
            BookingClassroom::create([
                'time_in' => $vendor['time_in'],
                'time_out' => $vendor['time_out'],
                'name' => $vendor['name'],
                'student_id' => $vendor['student_id'],
                'classroom_id' => $vendor['classroom_id'],
            ]);
        }
    }
}
