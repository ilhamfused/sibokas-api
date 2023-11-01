<?php

namespace Database\Seeders;

use App\Models\PicRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PicRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $picRoom = [
            [
                "name" => "Yanto",
            ],
            [
                "name" => "Budi",
            ],
            [
                "name" => "Adi",
            ],
        ];
        foreach ($picRoom as $vendor) {
            PicRoom::create([
                'name' => $vendor['name'],
            ]);
        }
    }
}
