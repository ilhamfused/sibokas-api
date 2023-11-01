<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $building = [
            [
                "building_code" => "SB",
                "name" => "Gedung Sekolah B",
            ],
            [
                "building_code" => "MST",
                "name" => "Gedung Magister Terapan",
            ],
            [
                "building_code" => "GKT",
                "name" => "Gedung Kuliah Terpadu",
            ],
        ];
        foreach ($building as $vendor) {
            Building::create([
                'building_code' => $vendor['building_code'],
                'name' => $vendor['name'],
            ]);
        }
    }
}
