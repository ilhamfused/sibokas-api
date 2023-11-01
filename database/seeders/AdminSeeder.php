<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            [
                "name" => "adminsibokas",
                "email" => 'adminsibokas@gmail.com',
                "password" => "password"
            ],
        ];
        foreach ($admin as $vendor) {
            Admin::create([
                'name' => $vendor['name'],
                'email' => $vendor['email'],
                'password' => bcrypt($vendor['password'])
            ]);
        }
    }
}
