<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = [
            [
                "name" => "SB I/01",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB I/02",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB I/03",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB I/04",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB I/05",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB I/06",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/01",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/02",
                "name_alias" => "Ruang Programming & Basis Data",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/03",
                "name_alias" => "Lab Gambar",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/04",
                "name_alias" => "Studio Gambar",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/05",
                "name_alias" => "Lab Multimedia",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/06",
                "name_alias" => "Lab Jaringan",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "SB II/07",
                "name_alias" => "Lab Komputer",
                "status" => 1,
                'pic_room_id' => '1',
                'building_id' => '1'
            ],
            [
                "name" => "MST III/03",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '2',
                'building_id' => '2'
            ],
            [
                "name" => "MST III/04",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '2',
                'building_id' => '2'
            ],
            [
                "name" => "MST III/05",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '2',
                'building_id' => '2'
            ],
            [
                "name" => "MST III/06",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '2',
                'building_id' => '2'
            ],
            [
                "name" => "GKT VIII/03",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '3',
                'building_id' => '3'
            ],
            [
                "name" => "GKT VIII/06",
                "name_alias" => null,
                "status" => 1,
                'pic_room_id' => '3',
                'building_id' => '3'
            ],
        ];
        foreach ($classroom as $vendor) {
            Classroom::create([
                'name' => $vendor['name'],
                'name_alias' => $vendor['name_alias'],
                'status' => $vendor['status'],
                'pic_room_id' => $vendor['pic_room_id'],
                'building_id' => $vendor['building_id']
            ]);
        }
    }
}
