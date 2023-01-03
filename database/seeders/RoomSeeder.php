<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name' => 'Ruang 101',
            'floor' => 1,
            'capacity' => 100
        ]);
        
        Room::create([
            'name' => 'Ruang 102',
            'floor' => 1,
            'capacity' => 50
        ]);
        
        Room::create([
            'name' => 'Ruang 103',
            'floor' => 1,
            'capacity' => 200
        ]);
        
        Room::create([
            'name' => 'Ruang 104',
            'floor' => 1,
            'capacity' => 100
        ]);
        
        Room::create([
            'name' => 'Ruang 201',
            'floor' => 2,
            'capacity' => 100
        ]);
        
        Room::create([
            'name' => 'Ruang 202',
            'floor' => 2,
            'capacity' => 20
        ]);
    }
}
