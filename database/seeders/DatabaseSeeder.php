<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PicRoomSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\BuildingSeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\ClassroomScheduleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminSeeder::class,
            BuildingSeeder::class,
            PicRoomSeeder::class,
            SemesterSeeder::class,
            ClassroomSeeder::class,
            ClassroomScheduleSeeder::class,
            StudentSeeder::class,
            ClassroomReportSeeder::class
        ]);
    }
}
