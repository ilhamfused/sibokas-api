<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = [
            [
                "name" => "TI-A-2021",
                "email" => "tia2021@gmail.com",
                "password" => "password",
            ],
            [
                "name" => "TI-B-2021",
                "email" => "tib2021@gmail.com",
                "password" => "password",
            ],
            [
                "name" => "TI-C-2021",
                "email" => "tic2021@gmail.com",
                "password" => "password",
            ],
        ];
        foreach ($student as $vendor) {
            Student::create([
                'name' => $vendor['name'],
                'email' => $vendor['email'],
                'password' => bcrypt($vendor['password']),
            ]);
        }
    }
}
