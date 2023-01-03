<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Database\Seeder;

class RoomFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();

        foreach($rooms as $room) {
            RoomFacility::insert([
                'room_id' => $room->id,
                'facility_id' => Facility::inRandomOrder()->get()->first()->id,
                'quantity' => rand(10, 100)
            ]);
        }
    }
}
