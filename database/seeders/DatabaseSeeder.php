<?php

namespace Database\Seeders;

use App\Models\RoomFacility;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            DivisionSeeder::class,
            UserAdminSeeder::class,
            UserMemberSeeder::class,
            FacilitySeeder::class,
            RoomSeeder::class,
            RoomFacilitySeeder::class
        ]);
    }
}
