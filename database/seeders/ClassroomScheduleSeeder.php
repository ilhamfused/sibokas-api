<?php

namespace Database\Seeders;

use App\Models\ClassroomSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom_schedule = [
            // SENIN
            [
                "day_of_week" => 1,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 1,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 1,
                "start_time" => "12:30:00",
                "end_time" => "17:30:00",
                'semester_id' => 1,
                'classroom_id' => 1,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 1,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 2,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 1,
                "start_time" => "08:30:00",
                "end_time" => "11:30:00",
                'semester_id' => 1,
                'classroom_id' => 2,
                'admin_id' => 1
            ],
            // SELASA
            [
                "day_of_week" => 2,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 3,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 2,
                "start_time" => "08:30:00",
                "end_time" => "15:30:00",
                'semester_id' => 1,
                'classroom_id' => 3,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 2,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 4,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 2,
                "start_time" => "12:30:00",
                "end_time" => "17:30:00",
                'semester_id' => 1,
                'classroom_id' => 4,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 2,
                "start_time" => "07:00:00",
                "end_time" => "11:30:00",
                'semester_id' => 1,
                'classroom_id' => 5,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 2,
                "start_time" => "12:00:00",
                "end_time" => "14:00:00",
                'semester_id' => 1,
                'classroom_id' => 5,
                'admin_id' => 1
            ],
            // RABU
            [
                "day_of_week" => 3,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 6,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 3,
                "start_time" => "08:30:00",
                "end_time" => "15:30:00",
                'semester_id' => 1,
                'classroom_id' => 6,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 3,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 7,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 3,
                "start_time" => "12:30:00",
                "end_time" => "17:30:00",
                'semester_id' => 1,
                'classroom_id' => 7,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 3,
                "start_time" => "07:00:00",
                "end_time" => "11:30:00",
                'semester_id' => 1,
                'classroom_id' => 8,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 3,
                "start_time" => "12:00:00",
                "end_time" => "14:00:00",
                'semester_id' => 1,
                'classroom_id' => 8,
                'admin_id' => 1
            ],
            // KAMIS
            [
                "day_of_week" => 4,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 9,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 4,
                "start_time" => "08:30:00",
                "end_time" => "15:30:00",
                'semester_id' => 1,
                'classroom_id' => 9,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 4,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 10,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 4,
                "start_time" => "12:30:00",
                "end_time" => "17:30:00",
                'semester_id' => 1,
                'classroom_id' => 10,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 4,
                "start_time" => "07:00:00",
                "end_time" => "11:30:00",
                'semester_id' => 1,
                'classroom_id' => 11,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 4,
                "start_time" => "12:00:00",
                "end_time" => "14:00:00",
                'semester_id' => 1,
                'classroom_id' => 11,
                'admin_id' => 1
            ],
            // JUMAT
            [
                "day_of_week" => 5,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 12,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 5,
                "start_time" => "08:30:00",
                "end_time" => "15:30:00",
                'semester_id' => 1,
                'classroom_id' => 12,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 5,
                "start_time" => "07:00:00",
                "end_time" => "08:30:00",
                'semester_id' => 1,
                'classroom_id' => 13,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 5,
                "start_time" => "12:30:00",
                "end_time" => "17:30:00",
                'semester_id' => 1,
                'classroom_id' => 13,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 5,
                "start_time" => "07:00:00",
                "end_time" => "11:30:00",
                'semester_id' => 1,
                'classroom_id' => 14,
                'admin_id' => 1
            ],
            [
                "day_of_week" => 5,
                "start_time" => "12:00:00",
                "end_time" => "14:00:00",
                'semester_id' => 1,
                'classroom_id' => 14,
                'admin_id' => 1
            ],

        ];
        foreach ($classroom_schedule as $vendor) {
            ClassroomSchedule::create([
                'day_of_week' => $vendor['day_of_week'],
                'start_time' => $vendor['start_time'],
                'end_time' => $vendor['end_time'],
                'semester_id' => $vendor['semester_id'],
                'classroom_id' => $vendor['classroom_id'],
                // 'admin_id' => $vendor['admin_id'],
            ]);
        }
    }
}
